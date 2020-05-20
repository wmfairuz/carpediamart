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

Route::get('/', 'GuestController')->name('landing');

Auth::routes();

Route::get('/account', function() {
    return view('account');
})->name('account');

Route::get('/signup', function() {
    return view('signup');
})->name('signup');

Route::get('/orders', 'OrderController@create')->name('orders.create');
Route::post('/orders', 'OrderController@store')->name('orders.store');
Route::get('/orders/remove/{product}', 'OrderController@removeProductFromCart')->name('orders.remove');
Route::get('/orders/clear', 'OrderController@clearCart')->name('orders.clear');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'HomeController@profile')->name('profile');

//    Route::resource('orders', 'OrderController')->except([
//        'create', 'store'
//    ]);
});