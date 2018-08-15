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


Auth::routes();

Route::get('/', 'HomeController@index')->name('homePage');
Route::get('home', 'HomeController@index')->name('home');

Route::post('search-home', 'HomeController@search')->name('searchHome');
Route::post('search', 'HomeController@search');

Route::get('load-streets', 'HomeController@loadStreets')->name('loadStreets');
Route::get('streets', 'HomeController@loadStreets');

Route::get('/search-home/{id}', 'SearchHomeController@index')->where('id', '[0-9]+')->name('searchHomePage');

Route::get('membership', 'MembershipController@index');

Route::group(['middleware' => ['auth']], function () {
	Route::get('dashboard', 'DashboardController@index');
	Route::get('dashboard/customers', 'CustomerController@index');
	Route::get('dashboard/profile', 'ProfileController@index');
	Route::post('profile', 'ProfileController@update')->name('profile');

	// route for processing payment
	Route::get('payment/paypal', 'PaymentController@payWithpaypal');

	// route for check status of the payment
	Route::get('status', 'PaymentController@getPaymentStatus')->name('status');
});
