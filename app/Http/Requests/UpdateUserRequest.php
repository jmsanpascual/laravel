<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->user;

        return  [
            'name' => 'required',
            'username' => 'required|min:3|unique:users,username,'.$id,
            'password' => 'min:3',
            'regions' => 'required',
            'regions.*.permissions' => 'required',
        ];
    }
}
