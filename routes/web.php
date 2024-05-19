<?php

use App\Http\Controllers\PaypalController;
use App\Livewire\Shop\IndexComponent;
use App\Livewire\Shop\CheckoutComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Shop\Cart\IndexComponent as CartIndexComponent;

Route::get('/', IndexComponent::class)->name('shop.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cart', CartIndexComponent::class)->name('cart');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');

Route::get('/paypal/checkout/{order}', [PaypalController::class, 'getExpressCheckout'])->name('paypal.checkout');
Route::get('/paypal/success/{order}', [PaypalController::class, 'getExpressCheckoutSuccess'])->name('paypal.success');
Route::get('/paypal/cancel', [PaypalController::class, 'cancelPage'])->name('paypal.cancel');
