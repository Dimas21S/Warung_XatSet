<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

Route::controller(AuthController::class)->group(function () {
    // Terkait dengan login
    Route::get('/login', 'getLogin')->name('login');
    Route::post('/login', 'postLogin')->name('login.post');

    // Terkait dengan register
    Route::get('/register', 'getRegister')->name('register');
    Route::post('/register', 'postRegister')->name('register.post');

    //
    Route::post('/logout', 'postLogout')->name('logout');
});

Route::controller(MenuController::class)->group(function () {

    Route::get('/', 'getBeranda')->name('beranda');
    Route::get('/produk', 'getProduk')->name('produk');
    Route::post('/produk', 'postProduk')->name('produk.post');
});

Route::get('/deskripsi', function () {
    return view('user.deskripsi-produk');
})->name('deskripsi-produk');


Route::controller(OrderController::class)->group(function () {
    Route::get('/keranjang', 'getKeranjang')->name('keranjang');
    Route::post('/keranjang', 'postKeranjang')->name('keranjang.post');

    Route::post('keranjang/tambah-qty', 'tambahQty')->name('keranjang.tambah');
    Route::post('keranjang/kurang-qty', 'kurangQty')->name('keranjang.kurang');
    Route::post('keranjang/hapus-item', 'hapusItem')->name('keranjang.hapus');

    Route::get('/konfirmasi', 'getKonfirmasi')->name('konfirmasi');

    Route::get('/checkout', 'getCheckout')->name('checkout');
    Route::post('/checkout', 'postCheckout')->name('checkout.post');
});