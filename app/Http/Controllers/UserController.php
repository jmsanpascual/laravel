<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\UserRegionAccess;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->with('role')->with('regions')->get();
    }

    public function store(UserRegionAccess $regionAccess, Request $request)
    {
        $user = $request->except('regions');
        $regions = $request->input('regions');

        $newUser = $this->user->create($user);
        $regionPermissions = $regionAccess->buildPermissions($newUser->id, $regions);
        $regionAccess->insert($regionPermissions);
        return;
    }

    public function update(Request $request)
    {
        $user = $request->all();
        $this->user->fill($user);
        $this->user->save();

        return $this->user->getUserWithRole();
    }

    public function destroy($id)
    {
        $this->user->where('id', $id)->delete();
        return;
    }
}
