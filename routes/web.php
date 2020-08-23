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
	Route::post('pos/transaction/store', 'POSController@storeTransaction');
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
	Route::get('barcode/product/{product}', 'MProduct\BarcodeController@get')->name('barcode-product');
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
		Route::get('product', 'MSale\DiscountProductController@index')->name('discount-product.index');
		Route::post('product/store', 'MSale\DiscountProductController@store')->name('discount-product.store');
		Route::patch('product/{product}/update', 'MSale\DiscountProductController@update')->name('discount-product.update');
		Route::delete('product/{product}/destroy', 'MSale\DiscountProductController@destroy')->name('discount-product.destroy');
		Route::get('search/product', 'MSale\DiscountProductController@searchProduct');
	});
	//DISCOUNT
	Route::get('discount/generate', 'MSale\DiscountController@generate')->name('discount-generate');
	Route::resource('discount', 'MSale\DiscountController');

	//-----MSUPPLIER-----//
	Route::group(["prefix" => "supplier"], function() {
		//PRODUCT SUPPLIER
		Route::get('product', 'MSupplier\ProductSupplierController@index')->name('product-supplier.index');
		Route::post('product/store', 'MSupplier\ProductSupplierController@store')->name('product-supplier.store');
		Route::patch('product/{product}/update', 'MSupplier\ProductSupplierController@update')->name('product-supplier.update');
		Route::delete('product/{product}/destroy', 'MSupplier\ProductSupplierController@destroy')->name('product-supplier.destroy');
		Route::get('product/csv', 'MSupplier\ProductSupplierController@exportCSV')->name('product-supplier-csv');
		Route::get('product/excel', 'MSupplier\ProductSupplierController@exportExcel')->name('product-supplier-excel');
		Route::get('product/pdf', 'MSupplier\ProductSupplierController@exportPDF')->name('product-supplier-pdf');
		//PRODUCT PURCHASEMENT
		Route::get('purchasement/search/product', 'MSupplier\PurchasementSupplierController@searchProduct');
		Route::get('purchasement', 'MSupplier\PurchasementSupplierController@index')->name('purchasement-supplier.index');
		Route::get('purchasement/create', 'MSupplier\PurchasementSupplierController@create')->name('purchasement-supplier.create');
		Route::post('purchasement/store', 'MSupplier\PurchasementSupplierController@store')->name('purchasement-supplier.store');
		Route::delete('purchasement/{purchasement}/destroy', 'MSupplier\PurchasementSupplierController@destroy')->name('purchasement-supplier.destroy');
		Route::get('purchasement/csv', 'MSupplier\PurchasementSupplierController@exportCSV')->name('purchasement-supplier-csv');
		Route::get('purchasement/excel', 'MSupplier\PurchasementSupplierController@exportExcel')->name('purchasement-supplier-excel');
		Route::get('purchasement/pdf', 'MSupplier\PurchasementSupplierController@exportPDF')->name('purchasement-supplier-pdf');
	});
	//SUPPLIER
	Route::get('supplier/csv', 'MSupplier\SupplierController@exportCSV')->name('supplier-csv');
	Route::get('supplier/excel', 'MSupplier\SupplierController@exportExcel')->name('supplier-excel');
	Route::get('supplier/pdf', 'MSupplier\SupplierController@exportPDF')->name('supplier-pdf');
	Route::resource('supplier', 'MSupplier\SupplierController');

	//-----MBRANCH-----//
	//BRANCH
	Route::get('branch/csv', 'MBranch\BranchController@exportCSV')->name('branch-csv');
	Route::get('branch/excel', 'MBranch\BranchController@exportExcel')->name('branch-excel');
	Route::get('branch/pdf', 'MBranch\BranchController@exportPDF')->name('branch-pdf');
	Route::resource('branch', 'MBranch\BranchController');
	
});