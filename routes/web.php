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
define('ROUTE_ROLE_MANAGER', 'role:' . \App\User::ROLE_MANAGER);
define('ROUTE_ROLE_CLIENT', 'role:' . \App\User::ROLE_CLIENT);

Route::get('/', 'HomeController@index')->name('login');

Route::group(['prefix' => 'client-request', 'middleware' => 'auth'], function () {
    Route::group(['middleware' => ROUTE_ROLE_MANAGER], function () {
        Route::get('download-file/{id}', 'ClientRequestController@downloadFile');
        Route::put('{id}', 'ClientRequestController@update');
        Route::get('/', 'ClientRequestController@index');
    });

    Route::group(['middleware' => [ROUTE_ROLE_CLIENT, 'elapsed.client.request']], function () {
        Route::get('create', 'ClientRequestController@create');
        Route::post('/', 'ClientRequestController@store');
    });
});

Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', 'AuthController@loginPage');
        Route::get('create', 'AuthController@create');
        Route::post('login', 'AuthController@login');
        Route::post('registration', 'AuthController@registration');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'AuthController@logoutPage');
        Route::post('logout', 'AuthController@logout');
    });
});

