<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreDealerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'region_id' => 'required',
            'city' => 'required',
            'province' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
        ];
    }
}
