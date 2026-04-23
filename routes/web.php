<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;

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

    Route::get('/beranda', 'getBeranda')->name('beranda');

});