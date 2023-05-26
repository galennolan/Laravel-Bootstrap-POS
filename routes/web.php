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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController')->names('categories');
Route::resource('customers', 'CustomerController')->names('customers');
Route::resource('suppliers', 'SupplierController')->names('suppliers');
Route::resource('employees', 'EmployeeController')->names('employees');
Route::resource('expenses', 'ExpenseController')->names('expenses');
Route::resource('products', 'ProductController')->names('products');
Route::resource('salaries', 'SalaryController')->names('salaries');
Route::delete('/salaries/{salary}', 'SalaryController@destroy')->name('salaries.destroy');
Route::get('/salaries', 'SalaryController@index')->name('salaries.index');
Route::get('salaries/{id}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::post('/submit', 'OrderController@order_submit')->name('submit');
    Route::get('/today', 'OrderController@today_order')->name('today');
    Route::get('/{id}', 'OrderController@view_order_details')->name('details');
    Route::get('/', 'OrderController@all_orders')->name('all');
});

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::post('/cart/{id}/increase', 'CartController@increase')->name('cart.increase');
Route::post('/cart/{id}/decrease', 'CartController@decrease')->name('cart.decrease');
Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');
Route::put('/cart/{id}','CartController@update')->name('cart.update');
Route::post('/cart/order', 'CartController@order')->name('cart.order');
Route::view('/cart/success', 'cart.success')->name('order.success');
Route::resource('returns', ReturnController::class)->only(['index', 'create', 'store']);
// routes/web.php

// Route for category_product
Route::get('/category-product/{id}','PosController@categoryProduct')->name('pos.categoryProduct');

// Route for today_history
Route::get('/today-history', 'PosController@todayHistory')->name('pos.todayHistory');

// Route for yesterday_history
Route::get('/yesterday-history', 'PosController@yesterdayHistory')->name('pos.yesterdayHistory');

