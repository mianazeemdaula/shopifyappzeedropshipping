<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::middleware(['verify.shopify'])->group(function () {
    Route::get('/','App\Http\Controllers\ShopifyStoreController@index')->name('home');

    Route::get('/callback', 'App\Http\Controllers\ShopifyStoreController@callback')->name('callback');
    Route::get('/orders', 'App\Http\Controllers\ShopifyStoreController@orders')->name('orders');
    Route::get('/export-orders', 'App\Http\Controllers\ShopifyStoreController@exportorders')->name('exportorders');
});

Route::middleware(['auth.webhook'])->group(function () {
    Route::post('/app/customer/data', function(Request $request){
        Log::info('Customer data received');
        Log::info($request->all());
        return response()->json(['message' => 'data fetched successfully']);
    });

    Route::post('/app/customer/erasure', function(Request $request){
        Log::info('Customer data removed');
        Log::info($request->all());
        return response()->json(['message' => 'Data removed successfully']);
    });

    Route::post('/app/shop/erasure', function(Request $request){
        Log::info('Shop data removed');
        Log::info($request->all());
        return response()->json(['message' => 'Data removed successfully']);
    });
});