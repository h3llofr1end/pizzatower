<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteController::class, 'index']);
Route::get('/cart', [SiteController::class, 'cart']);
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/plus/{id}', [CartController::class, 'plus'])->name('cart.plus');
Route::get('/cart/minus/{id}', [CartController::class, 'minus'])->name('cart.minus');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders', [OrderController::class, 'index'])->name('orders');

Route::get('/set-currency/{currency}', function($currency){
    if (! in_array($currency, ['usd', 'eur'])) {
        abort(400);
    }

    session(['currency' => $currency]);
    return redirect()->back();
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
