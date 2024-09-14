<?php

use App\Http\Controllers\Client\HomeController;
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

Route::middleware(['ShareCategory'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/product', [HomeController::class, 'product'])->name('product');

    Route::get('/store', [HomeController::class, 'stores'])->name('store');
});

require __DIR__ . '/admin.php';
