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

Route::post('/loginweb', 'Auth\LoginController@loginWeb')->name('web.login');

Route::group(['middleware' => ['isAdmin'], 'prefix' => 'admin'], function() {
    Route::get('dashboard', 'HomeController@index')->middleware('isAuth')->name('dashboard');
    Route::get('users', 'UserController@index')->middleware('isAuth')->name('users');
    Route::get('orders', 'OrderController@index')->middleware('isAuth')->name('orders');
});

Route::get('/logout', 'UserController@logoutWeb')->name('web.logout');
