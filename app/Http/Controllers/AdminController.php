<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\Outlets;
use App\Models\Kategori;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $totalPenjualan = OrderItem::whereDate('created_at', '=', Carbon::today(),'and')->sum('qty');

        $totalPesanan = Order::whereDate('created_at', '=', Carbon::today(), 'and')->count();

        $totalKeuntungan = Order::whereDate('created_at', '=', Carbon::today(), 'and')->sum('total');

        $pesananTerbaru = Order::orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

        $produkTerlaris = OrderItem::with('menu')
                        ->selectRaw('menu_id, nama, SUM(qty) as total_terjual')
                        ->groupBy('menu_id', 'nama')
                        ->orderByDesc('total_terjual')
                        ->take(5)
                        ->get(['menu_id', 'nama', 'total_terjual']);


         // Data chart per bulan
        $chartData = OrderItem::selectRaw('MONTH(order_items.created_at) as bulan, SUM(qty) as total')
                        ->join('orders', 'order_items.order_id', '=', 'orders.id')
                        ->whereYear('order_items.created_at', date('Y'))
                        ->groupBy('bulan')
                        ->orderBy('bulan')
                        ->get();

        // Format jadi array 12 bulan
        $chartLabels = [];
        $chartValues = [];
        $namaBulan = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        for ($i = 1; $i <= 12; $i++) {
            $chartLabels[] = $namaBulan[$i - 1];
            $found = $chartData->firstWhere('bulan', $i);
            $chartValues[] = $found ? $found->total : 0;
        }
        return view('admin.dashboard', compact(
            'totalPenjualan',
            'totalPesanan',
            'totalKeuntungan',
            'pesananTerbaru',
            'produkTerlaris',
            'chartLabels',
            'chartValues',
        ));
    }

    public function pengiriman()
    {
        $pesanan = Order::where('jenis_pengiriman', '=', 'antar', 'and')
                    ->orderBy('id', 'desc')
                    ->get();

        return view('admin.pengiriman', compact('pesanan'));
    }

    public function keuangan()
    {
        $totalPemasukan      = Order::sum('total');
        $totalProfit         = Order::sum('total') - Order::sum('ongkir');
        $riwayatPesanan      = Order::all()->count();
        $pembayaranTertunda  = Order::where('status', '=', 'pending', 'and')->sum('total');
        $transaksi           = Order::orderBy('id', 'desc')->get();

        return view('admin.keuangan', compact(
            'totalPemasukan',
            'totalProfit',
            'riwayatPesanan',
            'pembayaranTertunda',
            'transaksi'
        ));
    }

    public function pesanan(Request $request)
    {
        $query = Order::query();

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter waktu
        if ($request->waktu) {
            if ($request->waktu === 'hari') {
                $query->whereDate('created_at', today());
            } elseif ($request->waktu === 'minggu') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($request->waktu === 'bulan') {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            }
        }

        // Search
        if ($request->cari) {
            $query->where('nama_penerima', 'like', '%' . $request->cari . '%');
        }

        $pesanan         = $query->orderBy('id', 'desc')->get();
        $pesananDitahan  = Order::where('status', 'ditahan')->count();
        $pesananDiproses = Order::where('status', 'pending')->count();
        $pesananDiantar  = Order::where('status', 'pengiriman')->count();
        $pesananSelesai  = Order::where('status', 'selesai')->count();

        return view('admin.pesanan', compact(
            'pesananDitahan',
            'pesananDiproses',
            'pesananDiantar',
            'pesananSelesai',
            'pesanan'
        ));
    }

    public function detailPesanan($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return response()->json($order);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Status berhasil diubah'
        ]);
    }

    public function produk()
    {
        $totalProduk  = Menu::query()->count();
        $totalTerjual = OrderItem::sum('qty');
        $produk       = Menu::orderBy('id', 'desc')->get();

        return view('admin.produk', compact('totalProduk', 'totalTerjual', 'produk'));
    }

    public function chartData(Request $request)
    {
        $filter = $request->filter ?? 'bulan';

        if ($filter === 'tahun') {
            // Per bulan dalam setahun
            $data = Order::selectRaw('MONTH(created_at) as label, SUM(total) as total')
                        ->whereYear('created_at', date('Y'))
                        ->groupBy('label')
                        ->orderBy('label')
                        ->get()
                        ->map(fn($item) => [
                            'label' => \Carbon\Carbon::create()->month($item->label)->format('M'),
                            'total' => $item->total
                        ]);

        } elseif ($filter === 'bulan') {
            // Per minggu dalam sebulan
            $data = Order::selectRaw('WEEK(created_at) as label, SUM(total) as total')
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', date('m'))
                        ->groupBy('label')
                        ->orderBy('label')
                        ->get()
                        ->map(fn($item) => [
                            'label' => 'Minggu ' . ($item->label % 4 + 1),
                            'total' => $item->total
                        ]);

        } else {
            // Per tanggal dalam sebulan
            $data = Order::selectRaw('DAY(created_at) as label, SUM(total) as total')
                        ->whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', date('m'))
                        ->groupBy('label')
                        ->orderBy('label')
                        ->get()
                        ->map(fn($item) => [
                            'label' => Carbon::create(
                                now()->year,
                                now()->month,
                                $item->label
                            )->translatedFormat('j F'),
                            'total' => $item->total
                        ]);
        }

        return response()->json($data)->header('Cache-Control', 'no-cache, no-store');
    }

    public function tambahProduk()
    {
        $kategoris = Kategori::all();
        $outlets   = Outlets::all();
        return view('admin.create_produk', compact('kategoris', 'outlets'));
    }

    public function storeProduk(Request $request)
    {
        $request->validate([
            'nama_menu'   => 'required|string',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'outlet_id'   => 'required|exists:outlets,id',
            'gambar'      => 'nullable|image|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('produk', 'public');
        }

        Menu::create([
            'nama_menu'    => $request->nama_menu,
            'harga'        => $request->harga,
            'stok'         => $request->stok,
            'deskripsi'    => $request->deskripsi,
            'kategori_id'  => $request->kategori_id,
            'outlet_id'    => $request->outlet_id,
            'gambar'       => $gambar,
            'is_available' => $request->is_available,
        ]);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function editProduk($id)
    {
        $menu      = Menu::findOrFail($id);
        $kategoris = Kategori::all();
        $outlets   = Outlets::all();

        return view('admin.update_produk', compact('menu', 'kategoris', 'outlets'));
    }

    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama_menu'   => 'required|string',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'outlet_id'   => 'required|exists:outlets,id',
            'gambar'      => 'nullable|image|max:2048',
        ]);

        $menu = Menu::findOrFail($id);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $gambar = $request->file('gambar')->store('produk', 'public');
        } else {
            $gambar = $menu->gambar; // tetap pakai gambar lama
        }

        $menu->update([
            'nama_menu'    => $request->nama_menu,
            'harga'        => $request->harga,
            'stok'         => $request->stok,
            'deskripsi'    => $request->deskripsi,
            'kategori_id'  => $request->kategori_id,
            'outlet_id'    => $request->outlet_id,
            'gambar'       => $gambar,
            'is_available' => $request->is_available,
        ]);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil diupdate!');
    }

    public function hapusProduk($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus gambar jika ada
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus!');
    }

    public function identitas()
    {
        $setting = Setting::first();
        $outlets = Outlets::all();
        return view('admin.pengaturan', compact('setting', 'outlets'));
    }

    // Update identitas utama
    public function updateIdentitas(Request $request)
    {
        $setting = Setting::firstOrNew([]);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $setting->logo = $request->file('logo')->store('logo', 'public');
        }

        $setting->nama_aplikasi = $request->nama_aplikasi;
        $setting->no_cs         = $request->no_cs;
        $setting->alamat        = $request->alamat;
        $setting->outlet_id     = $request->outlet_id;
        $setting->save();

        return redirect()->route('admin.identitas')->with('success_identitas', 'Identitas berhasil disimpan!');
    }

    // Update media
    public function updateMedia(Request $request)
    {
        $setting = Setting::firstOrNew([]);

        $setting->facebook  = $request->facebook;
        $setting->instagram = $request->instagram;
        $setting->twitter   = $request->twitter;
        $setting->whatsapp  = $request->whatsapp;
        $setting->save();

        return redirect()->route('admin.identitas')->with('success_media', 'Media berhasil disimpan!');
    }
}
