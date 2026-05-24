<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use App\Models\Menu;

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

    public function identitas()
    {
        $setting = Setting::query()->first();
        return view('admin.pengaturan', compact('setting'));
    }

    public function updateIdentitas(Request $request)
    {
        $setting = Setting::firstOrNew([]);

        // Data utama
        $setting->nama_aplikasi = $request->nama_aplikasi;
        $setting->logo          = $request->logo;
        $setting->no_cs         = $request->no_cs;
        $setting->alamat        = $request->alamat;

        // Media
        $setting->facebook      = $request->facebook;
        $setting->instagram     = $request->instagram;
        $setting->twitter       = $request->twitter;
        $setting->whatsapp      = $request->whatsapp;

        $setting->save();

        return back()->with('success', 'Identitas berhasil disimpan!');
    }

    public function pesanan()
    {
        $pesananDitahan  = Order::where('status', '=', 'ditahan', 'and')->count();
        $pesananDiproses = Order::where('status', '=', 'pending', 'and')->count();
        $pesananDiantar  = Order::where('status', '=', 'diantar', 'and')->count();
        $pesananSelesai  = Order::where('status', '=', 'selesai', 'and')->count();
        $pesanan         = Order::orderBy('id', 'desc')->get();

        return view('admin.pesanan', compact(
            'pesananDitahan',
            'pesananDiproses',
            'pesananDiantar',
            'pesananSelesai',
            'pesanan'
        ));
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
}
