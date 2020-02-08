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
    //Listar conductores
    Route::get('/drivers', [
        'uses' => 'DriversController@index',
        'as' => 'drivers.index'
    ]);
    //Formulario de creación de conductores
    Route::get('/drivers/create', [
        'uses' => 'DriversController@create',
        'as' => 'drivers.create'
    ]);
    //Guardar conductor
    Route::post('/drivers/store', [
        'uses' => 'DriversController@store',
        'as' => 'drivers.store'
    ]);
    //Formulario de edición de conductor
    Route::get('/drivers/edit/{id}', [
        'uses' => 'DriversController@edit',
        'as' => 'drivers.edit'
    ]);
    //Actualiza conductor
    Route::post('/drivers/update', [
        'uses' => 'DriversController@update',
        'as' => 'drivers.update'
    ]);
    //Elimina conductor
    Route::get('/drivers/{id}/destroy', [
        'uses' => 'DriversController@destroy',
        'as' => 'drivers.destroy'
    ]);

    //Listar propietarios
    Route::get('/owners', [
        'uses' => 'OwnersController@index',
        'as' => 'owners.index'
    ]);
    //Formulario de creación de propietarios
    Route::get('/owners/create', [
        'uses' => 'OwnersController@create',
        'as' => 'owners.create'
    ]);
    //Guardar propietario
    Route::post('/owners/store', [
        'uses' => 'OwnersController@store',
        'as' => 'owners.store'
    ]);
    //Formulario de edición de propietario
    Route::get('/owners/edit/{id}', [
        'uses' => 'OwnersController@edit',
        'as' => 'owners.edit'
    ]);
    //Actualiza propietario
    Route::post('/owners/update', [
        'uses' => 'OwnersController@update',
        'as' => 'owners.update'
    ]);
    //Elimina propietario
    Route::get('/owners/{id}/destroy', [
        'uses' => 'OwnersController@destroy',
        'as' => 'owners.destroy'
    ]);
});
