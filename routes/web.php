<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create', App\Http\Livewire\Product\Create::class)->name('products.create')->middleware('admin');

Route::get('/products/{product}', App\Http\Livewire\Product\Show::class)->name('products.show');

Route::get('/checkout', App\Http\Livewire\Checkout::class)->name('checkout')->middleware('check');

Route::get('/paypal/payment', [App\Http\Controllers\PaymentController::class, 'paypalPaymentRequest'])->name('paypal.payment');

Route::get('/paypal/checkout/{status}', [App\Http\Controllers\PaymentController::class, 'paypalCheckout'])->name('paypal.checkout');

Route::post('/stripe/checkout', [App\Http\Controllers\PaymentController::class, 'stripeCheckout'])->name('stripe.checkout');

Route::get('/order/complete/{order}', [App\Http\Controllers\CompleteOrderController::class, 'completeForm'])->name('order.complete');

Route::post('/order/{order}', [App\Http\Controllers\CompleteOrderController::class, 'completeOrder'])->name('complete');