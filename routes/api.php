<?php

use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\KategoriController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index']);

    // Produk
    Route::get('/produk',          [ProdukController::class, 'index']);
    Route::get('/produk/featured', [ProdukController::class, 'featured']);
    Route::get('/produk/{slug}',   [ProdukController::class, 'show']);
});
