<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::group(['middleware' => 'auth.store'], function() {
    //Post API Calls
    Route::post('post/hotel/store', 'HotelsController@processApiStore');
    Route::post('post/booking/store', 'BookingsController@processApiStore');
    Route::post('post/user/store', 'UsersController@processApiStore');

    //Get API Calls
    Route::get('get/hotels', 'HotelsController@processApiGet');
    Route::get('get/bookings', 'BookingsController@processApiGet');
    Route::get('get/users', 'UsersController@processApiGet');
    Route::get('get/passengers', 'UsersController@processApiGetPassengers');

});
