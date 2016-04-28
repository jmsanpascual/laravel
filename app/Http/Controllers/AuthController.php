<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Exceptions\ResponseException;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $credentials = $request->all();

        if (Auth::attempt($credentials)) {
            return;
        } else {
            return ['error' => 'These credentials do not match our records.'];
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
