<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'DashboardController@getHome')->name('dashboard');
//profile 

Route::prefix('/profile')->group(function(){
    Route::get('/edit', 'AccountController@getProfileEdit')->name('dashboard');

});

Route::prefix('connect')->group(function(){
    Route::get('/login', 'ConnectController@getLogin')->name('login');
    Route::get('/logout', 'ConnectController@getLogout')->name('logout');
    Route::get('/two/factor', 'ConnectController@getTwoFactor')->name('two_factor');
});

Route::prefix('api-js')->group(function(){
    //account
    Route::post('/connect/update', 'ApiJS\AccountController@postProfileUpdate');


    //conecct module
    Route::post('/connect/login', 'ApiJS\ConnectController@postLogin');
    Route::post('/connect/twofactor', 'ApiJS\ConnectController@postTwoFactor');
});

;