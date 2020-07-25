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

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/login', 'AuthController@login');
Route::post('auth/check', 'AuthController@checkLogin');
Route::get('auth/logout', 'AuthController@logout');

Route::group(['middleware' => 'pos_auth' ], function() {
	//DASHBOARD
	Route::get('dashboard', 'DashboardController@dashboard');

	//POS
	Route::get('pos', 'POSController@index');
	Route::get('pos/search/all', 'POSController@allProduct');
	Route::get('pos/search/product', 'POSController@searchProduct');
	Route::get('pos/search/category', 'POSController@searchCategory');
	Route::get('pos/search/unit', 'POSController@searchUnit');
	Route::post('pos/transaction/save', 'POSController@saveTransaction');
	//-----MUSER-----//
	
	
	//-----MPRODUCT-----//
	//CATEGORY
	Route::resource('category', 'MProduct\CategoryController');
	//UNIT
	Route::resource('unit', 'MProduct\UnitController');
	//PRODUCT
	Route::group(["prefix" => "product"], function() {
		Route::get('csv', 'MProduct\ProductController@exportCSV')->name('product-csv');
		Route::get('excel', 'MProduct\ProductController@exportExcel')->name('product-excel');
		Route::get('pdf', 'MProduct\ProductController@exportPDF')->name('product-pdf');
	});
	Route::resource('product', 'MProduct\ProductController');
	//BARCODE
	Route::get('barcode/product/{product}', 'MProduct\BarcodeController@get');
	Route::resource('barcode', 'MProduct\BarcodeController');

	//-----MSALE-----//
	//TRANSACTION
	Route::group(["prefix" => "transaction"], function() {
		Route::get('csv', 'MSale\TransactionController@exportCSV')->name('transaction-csv');
		Route::get('excel', 'MSale\TransactionController@exportExcel')->name('transaction-excel');
		Route::get('pdf', 'MSale\TransactionController@exportPDF')->name('transaction-pdf');
	});
	Route::resource('transaction', 'MSale\TransactionController');
	//DISCOUNT PRODUCT
	Route::group(["prefix" => "discount"], function() {
		Route::get('product', 'MSale\DiscountProductController@index');
		Route::post('product/store', 'MSale\DiscountProductController@store')->name('discount-product.store');
		Route::patch('product/{product}/update', 'MSale\DiscountProductController@update')->name('discount-product.update');
		Route::delete('product/{product}/destroy', 'MSale\DiscountProductController@destroy')->name('discount-product.destroy');
		Route::get('search/product', 'MSale\DiscountProductController@searchProduct');
	});
	//DISCOUNT
	Route::get('discount/generate', 'MSale\DiscountController@generate');
	Route::resource('discount', 'MSale\DiscountController');

	//-----MSUPPLIER-----//
	//SUPPLIER
	Route::resource('supplier', 'MSupplier\SupplierController');
});