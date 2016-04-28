<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    function index(User $user)
    {
        return $user->with('role')->get();
    }

    function store(User $user, Request $request)
    {
        logger($request->all());
    }

    function update(User $user, Request $request)
    {
        $userData = $request->all();
        $user->fill($userData);
        $user->save();

        return $user->getUserWithRole();
    }

    function destroy($id)
    {
        User::where('id', $id)->delete();
        return;
    }
}
