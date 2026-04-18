<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('kategoris', KategoriController::class);
Route::resource('produks', ProdukController::class);

// Route untuk stok hampir habis
Route::get('/stok-hampir-habis', [ProdukController::class, 'stokHampirHabis'])->name('stok.hampir.habis');
