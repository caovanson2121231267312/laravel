<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/admin.php';

Route::middleware(['ShareCategory'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/store', [HomeController::class, 'stores'])->name('store');

    Route::get('/cart', [OrderController::class, 'cart'])->name('cart')->middleware("checkAdminLogin");

    Route::post('/add_to_cart', [OrderController::class, 'add_to_cart'])->name('add_to_cart');

    Route::get('/{slug}', [HomeController::class, 'product'])->name('product');
});
