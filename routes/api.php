<?php

// use App\Http\Controllers\UserController;

use App\Http\Controllers\Api\testController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MarketerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/customer/login', [CustomerController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/customers', [CustomerController::class, 'indexApi']);
    Route::get('/customer/{id}', [CustomerController::class, 'showApi']);
    Route::post('/customer', [CustomerController::class, 'storeApi']);
    Route::put('/customer/updateApi/{id}', [CustomerController::class, 'updateApi']);
    Route::delete('/customer/{id}', [CustomerController::class, 'destroyApi']);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/deliveries', [DeliveryController::class, 'indexApi']);
    Route::get('/delivery/{id}', [DeliveryController::class, 'showApi']);
    Route::post('/delivery', [DeliveryController::class, 'storeApi']);
    Route::put('/delivery/updateApi/{id}', [DeliveryController::class, 'updateApi']);
    Route::delete('/delivery/{id}', [DeliveryController::class, 'destroyApi']);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/marketers', [MarketerController::class, 'indexApi']);
    Route::get('/marketer/{id}', [MarketerController::class, 'showApi']);
    Route::post('/marketer', [MarketerController::class, 'storeApi']);
    Route::put('/marketer/updateApi/{id}', [MarketerController::class, 'updateApi']);
    Route::delete('/marketer/{id}', [MarketerController::class, 'destroyApi']);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/products', [ProductController::class, 'indexApi']);
    Route::get('/product/{id}', [ProductController::class, 'showApi']);
    Route::post('/product', [ProductController::class, 'storeApi']);
    Route::put('/product/updateApi/{id}', [ProductController::class, 'updateApi']);
    Route::delete('/product/{id}', [ProductController::class, 'destroyApi']);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/addresses', [AddressController::class, 'indexApi']);
    Route::get('/address/{id}', [AddressController::class, 'showApi']);
    Route::post('/address', [AddressController::class, 'storeApi']);
    Route::put('/address/updateApi/{id}', [AddressController::class, 'updateApi']);
    Route::delete('/address/{id}', [AddressController::class, 'destroyApi']);
});

//make register public to return token then use it in log in
//to delete token auth()->user()->tokens()->delete();