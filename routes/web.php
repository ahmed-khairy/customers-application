<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
});
Route::get('/s', 'App\Http\Controllers\CustomerController@test');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('customers_list', 'App\Http\Controllers\CustomerController');
	Route::resource('deliveries_list', 'App\Http\Controllers\DeliveryController');
	Route::resource('marketers_list', 'App\Http\Controllers\MarketerController');
	Route::resource('products_list', 'App\Http\Controllers\ProductController');
	Route::resource('addresses_list', 'App\Http\Controllers\AddressController');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
});
Route::group(['middleware' => 'auth'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
