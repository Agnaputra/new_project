<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\StockHistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::post('/stock/in', [StockController::class, 'stockIn'])
        ->name('stock.in');

    Route::post('/stock/out', [StockController::class, 'stockOut'])
        ->name('stock.out');

    Route::get('/import/products', [ImportController::class, 'show'])
        ->name('import.products');

    Route::post('/import/products', [ImportController::class, 'import'])
        ->name('import.products.store');
    
    Route::get('/stock-histories', [StockHistoryController::class, 'index'])
        ->name('stock.histories');

    Route::post('/stock/in',  [StockController::class, 'stockIn'])->name('stock.in');
    Route::post('/stock/out', [StockController::class, 'stockOut'])->name('stock.out');

    Route::get('/products/export', [ProductController::class, 'export'])
        ->name('products.export');

    Route::get('/import/products', [ImportController::class, 'show'])
        ->name('import.products');

    Route::post('/import/products', [ImportController::class, 'import'])
        ->name('import.products.store');

    
});

require __DIR__.'/auth.php';
