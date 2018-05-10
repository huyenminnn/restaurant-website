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

Auth::routes();

Route::group(['prefix' => 'admin'], function() {
    // Authentication Routes...
	Route::get('', 'AdminAuth\LoginController@showLoginForm');
	Route::get('login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');

	Route::post('login', 'AdminAuth\LoginController@login')->name('admin.login.process');
	Route::post('logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

    // Registration Routes...
	Route::get('register', 'AdminAuth\RegisterController@showRegistrationForm')->name('admin.register');
	Route::post('register', 'AdminAuth\RegisterController@register')->name('admin.signin');

    // Password Reset Routes...
	Route::get('password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('password/reset', 'AdminAuth\ResetPasswordController@reset');

});


//Google login
Route::get('login/google', 'AdminAuth\GoogleController@redirectToProvider')->name('admin.login.google');

Route::get('login/google/callback', 'AdminAuth\GoogleController@handleProviderCallback');

Route::prefix('admin')->middleware('admin')->group(function(){

	//Redirect to home
	Route::get('/','AdminController@getIndex')->name('admin.home');

	Route::get('/home','AdminController@getIndex');

	/**
	 * CATEGORY
	 */
	Route::group(['prefix' => 'category'], function() {
	    
	    Route::get('/', 'Admin\CategoryController@getIndex')->name('admin.category.list');

	    Route::get('/listCategory', 'Admin\CategoryController@anyData')->name('admin.category.dataTable');

	    Route::post('/', 'Admin\CategoryController@store')->name('admin.category.store');

	    Route::delete('/delete/{id}', 'Admin\CategoryController@destroy');

	    Route::get('/{id}', 'Admin\CategoryController@show');

	    Route::get('/edit/{id}', 'Admin\CategoryController@edit')->name('admin.category.edit');

	    Route::put('/update/{id}', 'Admin\CategoryController@update')->name('admin.category.update');
	});

	Route::group(['prefix' => 'product'], function() {
	    
	    Route::get('/', 'Admin\ProductController@getIndex')->name('admin.product.list');

	    Route::get('/listProduct', 'Admin\ProductController@anyData')->name('admin.product.dataTable');

	    Route::post('/store', 'Admin\ProductController@store')->name('admin.product.store');

	    Route::get('/{id}','Admin\ProductController@show');

	    Route::get('/edit/{id}','Admin\ProductController@edit');

	    Route::put('/update/{id}', 'Admin\ProductController@update');

	    Route::delete('/delete/{id}', 'Admin\ProductController@destroy');
	});

	Route::group(['prefix' => 'customers'], function() {

	    Route::get('/', 'Admin\UserController@getIndex')->name('admin.user.list');
	});

	Route::group(['prefix' => 'booking'], function(){

		Route::get('/', 'Admin\BookingController@getIndex')->name('admin.booking.list');		

		Route::get('/listBooking', 'Admin\BookingController@anyData')->name('admin.booking.dataTable');

		Route::get('/{id}', 'Admin\BookingController@getBookingDetail');

		Route::delete('/delete/{id}', 'Admin\BookingController@destroy');

		Route::post('/store', 'Admin\BookingController@store')->name('admin.booking.store');

	});

	Route::group(['prefix' => 'pages'], function(){
		
		//slide
		Route::get('/slider', 'Admin\PageController@getSlider')->name('admin.pages.slider');

		Route::get('/loadSlider', 'Admin\PageController@anyData')->name('admin.pages.dataTable');

		Route::post('/slider', 'Admin\PageController@storeImage')->name('admin.pages.store');

		Route::delete('/delete/{id}', 'Admin\PageController@destroyImage');

		//about us page
		Route::get('/about-us', 'Admin\PageController@getAboutUs')->name('admin.pages.aboutUs');
		
	});

	Route::group(['prefix' => 'admins'], function(){

		Route::get('/','Admin\AdminController@adminIndex')->name('admin.admins.list');

		Route::get('/listUser','Admin\AdminController@getListUserDatatables')->name('admin.admins.dataTable');

		Route::get('/{id}','Admin\AdminController@adminShow')->name('admin.admins.show');

		Route::post('/store','Admin\AdminController@adminUserStore')->name('admin.admins.store');

		Route::put('/update/{id}','Admin\AdminController@adminUserUpdate')->name('admin.admins.update');

		Route::delete('/delete/{id}','Admin\AdminController@adminDelete')->name('admin.admins.delete');
	});

});


Route::get('/', 'Restaurant\HomeController@getIndex')->name('restaurant.home');

Route::get('/about-us', 'Restaurant\HomeController@getAboutUs')->name('restaurant.aboutUs');

Route::get('/booking', 'Restaurant\HomeController@getFormBooking')->name('restaurant.booking');

Route::get('/food', 'Restaurant\HomeController@getFood')->name('restaurant.food');

Route::get('/drink', 'Restaurant\HomeController@getDrink')->name('restaurant.drink');

Route::get('/booking/{id}','Restaurant\BookingController@bookProduct');

Route::get('/booking/increase/{rowId}','Restaurant\BookingController@increase');

Route::get('/booking/decrease/{rowId}','Restaurant\BookingController@decrease');

Route::get('/booking-list','Restaurant\BookingController@getBookList')->name('restaurant.booking.list');

Route::post('/booking', 'Restaurant\BookingController@booking')->name('restaurant.process_booking');




