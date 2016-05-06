<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->all();

        if (Auth::attempt($credentials)) {
            $regionsPermissions = Auth::user()->getRegionsAndPermissions();
            session()->put('permissions', $regionsPermissions);
            return;
        } else {
            return ['error' => 'These credentials do not match our records.'];
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
