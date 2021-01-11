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

Route::post('login', 'Api\AuthController@login')->name('api.login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout')->middleware('auth:api');
Route::get('getdata', 'PostController@getApiData');
Route::get('showdata', 'PostController@showdata');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('profile', 'Api\AuthController@profile');

    Route::group(['prefix' => 'user'], function() {
        Route::post('profile', 'Api\AuthController@apiProfile');
        Route::post('orders', 'OrderController@apiClientOrders');
        Route::post('directions', 'DirectionController@apiClientDirections');
    });

    Route::post('logued', 'Api\AuthController@isLogued');

    Route::group(['middleware' => ['isAdmin'], 'prefix' => 'admin'], function() {

        Route::post('users-directions', 'UserController@apiUsersWithDirections'); // Ok
        Route::post('orders-users', 'OrderController@apiOrdersWithUsers');
        Route::post('products', 'ProductController@apiProducts');
    });

    Route::post('users', 'UserController@showUsers');

});
