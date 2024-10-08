<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['verify.shopify'])->group(function () {
    Route::get('/','App\Http\Controllers\ShopifyStoreController@index')->name('home');

    Route::get('/callback', 'App\Http\Controllers\ShopifyStoreController@callback')->name('callback');
    Route::get('/orders', 'App\Http\Controllers\ShopifyStoreController@orders')->name('orders');
    Route::get('/export-orders', 'App\Http\Controllers\ShopifyStoreController@exportorders')->name('exportorders');

});