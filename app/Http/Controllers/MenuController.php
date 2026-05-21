<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    //
    public function getBeranda()
    {
        return view('user.beranda');
    }

    public function getProduk()
    {
        $menu = Menu::with('kategori', 'outlet')
                ->where('is_available', true)
                ->paginate(10);
        return view('user.produk', compact('menu'));
    }

    public function postProduk(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        if (!$menu->is_available) {
            return response()->json([
                'status'  => 'error',
                'message' => "Menu '{$menu->nama_menu}' tidak tersedia"
            ]);
        }

        $cart = session('cart', []);

        foreach ($cart as $item) {
            if ($item['menu_id'] == $request->menu_id) {
                return response()->json([
                    'status'  => 'error',
                    'message' => "'{$menu->nama_menu}' sudah ada di keranjang"
                ]);
            }
        }

        $cart[] = [
            'menu_id' => $request->menu_id,
            'nama'    => $menu->nama_menu,
            'harga'   => $menu->harga,
            'qty'     => 1,
        ];

        session(['cart' => $cart]);

        return response()->json([
            'status'  => 'success',
            'message' => "Menu '{$menu->nama_menu}' berhasil ditambahkan!",
            'qty'     => 1,           // ← tambah ini
            'menu_id' => $request->menu_id  // ← tambah ini
        ]);
    }

        // Tambah qty
    public function tambahQty(Request $request)
    {
        $cart = session('cart', []);

        foreach ($cart as $index => $item) {
            if ($item['menu_id'] == $request->menu_id) {
                $cart[$index]['qty']++;
                session(['cart' => $cart]);

                return response()->json([
                    'status' => 'success',
                    'qty'    => $cart[$index]['qty'],
                    'total'  => collect(session('cart'))->sum(fn($item) => $item['harga'] * $item['qty'])
                ]);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Item tidak ditemukan']);
    }

    // Kurang qty
    public function kurangQty(Request $request)
    {
        $cart = session('cart', []);

        foreach ($cart as $index => $item) {
            if ($item['menu_id'] == $request->menu_id) {
                if ($cart[$index]['qty'] > 1) {
                    $cart[$index]['qty']--;
                    session(['cart' => $cart]);

                    return response()->json([
                        'status' => 'success',
                        'qty'    => $cart[$index]['qty'],
                        'total'  => collect(session('cart'))->sum(fn($item) => $item['harga'] * $item['qty'])
                    ]);
                } else {
                    unset($cart[$index]);
                    $cart = array_values($cart);
                    session(['cart' => $cart]);

                    return response()->json([
                        'status' => 'hapus',
                        'total'  => collect(session('cart'))->sum(fn($item) => $item['harga'] * $item['qty'])
                    ]);
                }
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Item tidak ditemukan']);
    }

    public function createProduk()
    {
        return view('admin.create_produk');
    }

    public function updateProduk()
    {
        return view('admin.update_produk');
    }

    public function deleteProduk()
    {
        return view('admin.delete_produk'); 
    }
}
