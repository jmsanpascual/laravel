<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if (Auth::check()) return view('home');
    return view('login');
});

Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::post('datatable', function () {
    return request()->all();
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('user', 'UserController', [
        'only' => ['index', 'store', 'update', 'destroy']
    ]);
    Route::resource('role', 'RoleController', [
        'only' => ['index']
    ]);
    Route::resource('country', 'CountryController', [
        'only' => ['index']
    ]);
});
