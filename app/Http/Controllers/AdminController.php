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
                        ->selectRaw('menu_id, SUM(qty) as total_terjual')
                        ->groupBy('menu_id')
                        ->orderByDesc('total_terjual')
                        ->take(5)
                        ->get();


        return view('admin.dashboard', compact(
            'totalPenjualan',
            'totalPesanan',
            'totalKeuntungan',
            'pesananTerbaru',
            'produkTerlaris'
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
}
