<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->with('role', 'regions')->get();
    }

    public function store(StoreUserRequest $request)
    {
        $userInfo = $request->except('regions', 'role');
        $regions = $request->input('regions');

        $user = $this->user->create($userInfo);

        // Build the permission and insert in the pivot table
        $permissions = $user->regions()->buildPermissions($regions);
        $user->regions()->attach($permissions);

        $message = trans('messages.create', ['name' => $user->name]);
        return compact('message');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $userInfo = $request->except('regions', 'role');
        $regions = $request->input('regions');

        // Find and update the user
        $user = $this->user->find($id);
        $user->update($userInfo);

        // Build the permission and update the pivot table
        $permissions = $user->regions()->buildPermissions($regions);
        $user->regions()->sync($permissions);

        $message = trans('messages.update', ['name' => $user->name]);
        return compact('message');
    }

    public function destroy($id)
    {
        $user = $this->user->find($id);
        $user->delete();

        $message = trans('messages.delete', ['name' => $user->name]);
        return compact('message');
    }
}
