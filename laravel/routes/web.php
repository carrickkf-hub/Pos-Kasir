<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('kategoris', KategoriController::class);
Route::resource('produks', ProdukController::class);

// Route untuk stok hampir habis
Route::get('/stok-hampir-habis', [ProdukController::class, 'stokHampirHabis'])->name('stok.hampir.habis');

// Route untuk transaksi pembayaran
Route::get('/pembayaran', [TransaksiController::class, 'create'])->name('transaksis.create');
Route::post('/pembayaran', [TransaksiController::class, 'store'])->name('transaksis.store');
