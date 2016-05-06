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

Route::get('/', function (App\Role $role) {
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect('accounts');
        } else {
            return redirect('infos');
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

    Route::get('infos', function () {
        return view('infos');
    });
});

Route::group(['middleware' => ['auth', 'ajax']], function () {
    Route::resource('dealer', 'DealerController');

    Route::resource('user', 'UserController', [
        'only' => ['index', 'store', 'update', 'destroy']
    ]);

    Route::resource('role', 'RoleController', [
        'only' => ['index']
    ]);

    Route::resource('region', 'RegionController', [
        'only' => ['index']
    ]);

    Route::resource('permission', 'PermissionController', [
        'only' => ['index']
    ]);
});
