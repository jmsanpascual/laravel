<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Role;

class StoreUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Role $role)
    {
        return auth()->user()->role->name == 'Admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|min:4|unique:users',
            'password' => 'required|min:4',
            'regions' => 'required',
            'regions.*.permissions' => 'required',
        ];
    }
}
