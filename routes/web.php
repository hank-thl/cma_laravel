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
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/BackOffice','App\Http\Controllers\BackOfficeController@login');
Route::post('/BackOffice','App\Http\Controllers\BackOfficeController@postLogin');
Route::get('/BackOffice/products','App\Http\Controllers\BackOfficeController@products');

Route::resource('product','App\Http\Controllers\ProductsController');

Route::post('/register','App\Http\Controllers\CustomerController@createUser');
Route::post('/login','App\Http\Controllers\CustomerController@login');
Route::get('/getMember','App\Http\Controllers\CustomerController@getMember');
Route::get('/logout','App\Http\Controllers\CustomerController@logout');

Route::get('/addToCart/{id}/{qty}','App\Http\Controllers\CartController@addToCart');
Route::get('/reduceProduct/{id}/{qty}','App\Http\Controllers\CartController@reduceProduct');
Route::get('/removeProduct/{id}','App\Http\Controllers\CartController@removeProduct');
Route::get('/checkout','App\Http\Controllers\CartController@checkout');
Route::get('/clearCart','App\Http\Controllers\CartController@clearCart');

Route::post('/createOrder','App\Http\Controllers\OrderController@createOrder');
Route::get('/getOrders','App\Http\Controllers\OrderController@getOrders');

Route::get('/token', function () {
    return csrf_token(); 
});