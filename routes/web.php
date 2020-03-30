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
    return view('welcome');
});
Route::post('scorders/placeorder', 'scorderController@placeorder')->name('scorders.placeorder');
Route::get('scorders/checkout', 'scorderController@checkout')->name('scorders.checkout');
Route::get('products/displaygrid', 'productController@displaygrid')->name('products.displaygrid');

Route::get('products/additem/{id}', 'productController@additem')->name('products.additem');

Route::get('products/emptycart', 'productController@emptycart')->name('products.emptycart');

//Route::resource('scorders', 'scorderController');

//Route::resource('products', 'productController');

//Route::resource('orderdetails', 'orderdetailController');