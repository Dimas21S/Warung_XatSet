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

        // Cek ketersediaan menu
        if (!$menu->is_available) {
            return response()->json([
                'status'  => 'error',
                'message' => "Menu '{$menu->nama_menu}' tidak tersedia"
            ]);
        }

        $cart = session('cart', []);

        // Cek apakah menu sudah ada di cart
        foreach ($cart as $item) {
            if ($item['menu_id'] == $request->menu_id) {
                return response()->json([
                    'status'  => 'error',
                    'message' => "'{$menu->nama_menu}' sudah ada di keranjang"
                ]);
            }
        }

        // Tambah item baru ke cart
        $cart[] = [
            'menu_id' => $request->menu_id,
            'nama'    => $menu->nama_menu,
            'harga'   => $menu->harga,
            'qty'     => 1,
        ];

        session(['cart' => $cart]);

        return response()->json([
            'status'  => 'success',
            'message' => "Menu '{$menu->nama_menu}' berhasil ditambahkan ke keranjang!"
        ]);
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
