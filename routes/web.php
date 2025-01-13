<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('welcome');
});


// Halaman utama untuk menampilkan produk
Route::get('/Shop', [ProdukController::class, 'shop'])->name('Shop');
Route::get('produk/import', [ProdukController::class, 'importFromApi'])->name('produk.import');

Route::resource('produk', ProdukController::class)->except(['show']);
Route::resource('status', StatusController::class)->except(['show']);
Route::resource('kategori', KategoriController::class)->except(['show']);
