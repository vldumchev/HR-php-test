<?php

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
    return redirect()->route('orders.list');
});

Route::get('/current-temperature', 'ShowCurrentTemperature')->name('current-temperature');

Route::name('orders.')->group(function () {
    Route::prefix('orders')->group(function () {
        Route::get('/', 'OrderController@index')->name('list');
        Route::get('/{id}', 'OrderController@edit')->name('edit');
        Route::patch('/{id}', 'OrderController@update')->name('update');
    });
});

Route::get('/products', 'ProductController@index')->name('products.list');
