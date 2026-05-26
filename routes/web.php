<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

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
    Route::post('produk/tambah-qty', 'tambahQty')->name('produk.tambahQTY');
    Route::post('produk/kurang-qty', 'kurangQty')->name('produk.kurangQTY');

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
    Route::post('/konfirmasi', 'postKonfirmasi')->name('konfirmasi.post');
    // Route::get('/pesanan/sukses/{id}', [OrderController::class, 'sukses'])->name('pesanan.sukses');

    Route::get('/checkout', 'getCheckout')->name('checkout');
    Route::post('/checkout', 'postCheckout')->name('checkout.post');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    Route::get('/admin/pesanan', 'pesanan')->name('admin.pesanan');
    Route::get('/admin/pengiriman', 'pengiriman')->name('admin.pengiriman');
    Route::get('/admin/produk', 'produk')->name('admin.produk');
    Route::get('/admin/keuangan', 'keuangan')->name('admin.keuangan');
    Route::get('/admin/identitas', 'identitas')->name('admin.identitas');
    // Route::get('/admin/diskon', 'diskon')->name('admin.diskon');

    Route::get('/admin/pesanan/{id}/detail', [AdminController::class, 'detailPesanan'])->name('admin.pesanan.detail');
    Route::post('/admin/pesanan/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.pesanan.status');

    Route::get('/admin/produk/tambah', [AdminController::class, 'tambahProduk'])->name('admin.produk.tambah');
    Route::post('/admin/produk/store', [AdminController::class, 'storeProduk'])->name('admin.produk.store');

    Route::get('/admin/produk/{id}/edit', [AdminController::class, 'editProduk'])->name('admin.produk.edit');
    Route::put('/admin/produk/{id}/update', [AdminController::class, 'updateProduk'])->name('admin.produk.update');

    Route::delete('/admin/produk/{id}/hapus', [AdminController::class, 'hapusProduk'])->name('admin.produk.hapus');

    Route::put('/admin/identitas/update', [AdminController::class, 'updateIdentitas'])->name('admin.identitas.update');
    Route::put('/admin/identitas/media', [AdminController::class, 'updateMedia'])->name('admin.identitas.media');

    Route::get('/admin/chart-data', 'chartData')->name('admin.chartData');
});