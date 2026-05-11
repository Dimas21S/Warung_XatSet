<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;


class OrderController extends Controller
{
    //
    public function getKeranjang()
    {
        $cart = session('cart', []);
        return view('user.keranjang', compact('cart'));
    }

    // Tambah qty
    public function tambahQty(Request $request)
    {
        $cart = session('cart', []);
        $cart[$request->index]['qty']++;
        session(['cart' => $cart]);

        return response()->json([
            'status' => 'success',
            'qty'    => $cart[$request->index]['qty'],
            'total'  => collect(session('cart'))->sum(fn($item) => $item['harga'] * $item['qty'])
        ]);
    }

    // Kurang qty
    public function kurangQty(Request $request) 
    {
        $cart = session('cart', []);
        if ($cart[$request->index]['qty'] > 1) {
            $cart[$request->index]['qty']--;
            session(['cart' => $cart]);

            return response()->json([
                'status' => 'success',
                'qty'    => $cart[$request->index]['qty'],
                'total'  => collect(session('cart'))->sum(fn($item) => $item['harga'] * $item['qty'])
            ]);
        } else {
            unset($cart[$request->index]);
            $cart = array_values($cart);
            session(['cart' => $cart]);

            return response()->json([
                'status' => 'hapus',
                'total'  => collect(session('cart'))->sum(fn($item) => $item['harga'] * $item['qty'])
            ]);
        }
    }

    // Hapus item
    public function hapusItem(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->index]);
        $cart = array_values($cart);
        session(['cart' => $cart]);

        return response()->json([
            'status' => 'hapus',
            'total'  => collect(session('cart'))->sum(fn($item) => $item['harga'] * $item['qty'])
        ]);
    }

    public function getKonfirmasi()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['harga'] * $item['qty']);

        return view('user.konfirmasi', compact('cart', 'total'));
    }

    public function postCheckout(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'outlet_id'      => 'required|exists:outlets,id',
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'alamat'         => 'required|string|max:500',
        ]);

        // 2. Cek keranjang tidak kosong
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Keranjang kosong']);
        }

        // 3. Validasi setiap item di cart & hitung total dari DB (bukan dari session)
        $total = 0;
        $validatedItems = [];

        foreach ($cart as $item) {
            $menu = Menu::find($item['menu_id'], ['id', 'nama', 'harga']);

            if (!$menu) {
                return back()->withErrors(['cart' => "Menu '{$item['nama']}' tidak ditemukan."]);
            }

            if (!$menu->is_available) {
                return back()->withErrors(['cart' => "Menu '{$menu->nama}' tidak tersedia."]);
            }

            $subtotal = $menu->harga * $item['qty'];
            $total   += $subtotal;

            $validatedItems[] = [
                'menu_id'  => $menu->id,
                'qty'      => $item['qty'],
                'harga'    => $menu->harga, // pakai harga dari DB, bukan session
                'subtotal' => $subtotal,
            ];
        }

        // 4. Gunakan DB transaction agar data konsisten
        try {
            $order = DB::transaction(function () use ($request, $total, $validatedItems) {

                $order = Order::create([
                    'outlet_id'      => $request->outlet_id,
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'no_hp'          => $request->no_hp,
                    'alamat'         => $request->alamat,
                    'total_harga'    => $total,
                    'status'         => 'pending',
                ]);

                foreach ($validatedItems as $item) {
                    OrderItem::create([
                            'order_id' => $order->id,
                            'menu_id'  => $item['menu_id'],
                            'qty'      => $item['qty'],
                            'harga'    => $item['harga'],
                            'subtotal' => $item['subtotal'],
                        ]);
                    }

                return $order;
            });

            // 5. Hapus cart setelah order berhasil
            session()->forget('cart');

            // 6. Redirect ke halaman detail order (bukan back())
            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            Log::error('Checkout gagal: ' . $e->getMessage());

            return back()->withErrors(['checkout' => 'Terjadi kesalahan, silakan coba lagi.']);
        }
    }

    public function konfirmasi()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['harga'] * $item['qty']);
        $ongkir = 5000;
        $total = $subtotal + $ongkir;

        return view('user.konfirmasi', compact('cart', 'subtotal', 'ongkir', 'total'));
    }

    public function postKonfirmasi(Request $request)
    {
        $request->validate([
            'jenis_pengiriman'  => 'required',
            'metode_pembayaran' => 'required',
            'alamat'            => 'required_if:jenis_pengiriman,antar',
            'nama_penerima'     => 'required_if:jenis_pengiriman,antar',
            'no_telepon'        => 'required_if:jenis_pengiriman,antar',
            'waktu_pengiriman'  => 'required_if:jenis_pengiriman,antar',
        ]);

        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['harga'] * $item['qty']);
        $ongkir = 5000;
        $total = $subtotal + $ongkir;

        // Simpan order
        $order = Order::create([
            'outlet_id'         => 1, // sesuaikan
            'jenis_pengiriman'  => $request->jenis_pengiriman,
            'alamat'            => $request->alamat,
            'nama_penerima'     => $request->nama_penerima,
            'no_telepon'        => $request->no_telepon,
            'waktu_pengiriman'  => $request->waktu_pengiriman,
            'metode_pembayaran' => $request->metode_pembayaran,
            'subtotal'          => $subtotal,
            'ongkir'            => $ongkir,
            'total'             => $total,
            'status'            => 'pending',
        ]);

        // Simpan item
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id'  => $item['menu_id'],
                'nama'     => $item['nama'],
                'qty'      => $item['qty'],
                'harga'    => $item['harga'],
                'subtotal' => $item['harga'] * $item['qty'],
            ]);
        }

        // Kosongkan cart
        session()->forget('cart');

        return redirect()->route('user.selesai', $order->id);
    }

}
