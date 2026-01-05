<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/**
 * ROOT ROUTE
 * Akses "/" → jika login masuk dashboard
 * jika belum login → ke login
 */
Route::get('/', function () {
    return redirect()->route('dashboard');
});

/**
 * ROUTE YANG MEMBUTUHKAN LOGIN
 */
Route::middleware(['auth'])->group(function () {

    /**
     * ==================================
     * DASHBOARD (WAJIB UNTUK BREEZE)
     * ==================================
     * Breeze selalu mencari route bernama "dashboard"
     * Kita arahkan ke tabel stok
     */
    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');

    /**
     * ==================================
     * TABEL STOK BARANG
     * ==================================
     */
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    /**
     * ==================================
     * STOK MASUK & STOK KELUAR
     * ==================================
     */
    Route::post('/stock/in', [StockController::class, 'stockIn'])
        ->name('stock.in');

    Route::post('/stock/out', [StockController::class, 'stockOut'])
        ->name('stock.out');

    /**
     * ==================================
     * IMPORT EXCEL PRODUK
     * ==================================
     */
    Route::get('/import/products', [ImportController::class, 'show'])
        ->name('import.products');

    Route::post('/import/products', [ImportController::class, 'import'])
        ->name('import.products.store');
});

/**
 * ROUTE AUTHENTICATION (BREEZE)
 * JANGAN DIPINDAH & JANGAN DIUBAH
 */
require __DIR__.'/auth.php';
