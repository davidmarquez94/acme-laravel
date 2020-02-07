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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/drivers', [
        'uses' => 'DriversController@index',
        'as' => 'drivers.index'
    ]);

    Route::get('/drivers/create', [
        'uses' => 'DriversController@create',
        'as' => 'drivers.create'
    ]);
    Route::post('/drivers/store', [
        'uses' => 'DriversController@store',
        'as' => 'drivers.store'
    ]);
});
