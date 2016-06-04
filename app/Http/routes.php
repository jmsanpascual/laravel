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
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect('accounts');
        } else {
            return redirect('dealers');
        }
    }

    return view('login');
});

Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
// Route::post('datatable', function () {
//     return request()->all();
// });

Route::group(['middleware' => 'auth'], function () {
    Route::get('accounts', function () {
        if (!Auth::user()->isAdmin()) return view('errors.404');
        return view('accounts');
    });

    Route::get('dealers', function () {
        return view('dealers');
    });

    Route::get('couriers', function () {
        return view('couriers');
    });

    Route::get('regions', function () {
        return view('regions');
    });
});

Route::group(['middleware' => ['auth', 'ajax']], function () {
    Route::post('dealer/export', 'DealerController@export');
    Route::resource('dealer', 'DealerController');

    Route::post('courier/upload-template', 'CourierController@uploadTemplate');
    Route::resource('courier', 'CourierController');

    Route::resource('region', 'RegionController');

    Route::resource('user', 'UserController', [
        'only' => ['index', 'store', 'update', 'destroy']
    ]);

    Route::resource('role', 'RoleController', [
        'only' => ['index']
    ]);

    Route::resource('permission', 'PermissionController', [
        'only' => ['index']
    ]);
});
