<?php

use App\Livewire\Shop\IndexComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Shop\Cart\IndexComponent as CartIndexComponent;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', IndexComponent::class); 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cart',CartIndexComponent::class)->name('cart');