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

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', 'DashboardController@dashboard')->name('home');
    Route::get('/', 'DashboardController@dashboard');
    Route::get('/dashboard', 'DashboardController@dashboard');

    Route::resource('profile', 'ProfileController');


    Route::resource('users', 'UsersController');
    Route::resource('users/passengers', 'UsersController');

    Route::resource('hotels', 'HotelsController');
    Route::resource('bookings', 'BookingsController');
});

/*
 * Public Routes for PWD Reset
 */
Route::get('password/email', 'UsersController@forget_password')->name('password.email');
Route::post('password/request', 'UsersController@forget_password')->name('password.request');

Route::get('password-reset/{user_id}/{_token}', 'UsersController@reset_password');
Route::post('password/reset', 'UsersController@update_password')->name("password.update");
