<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Dealer;
use Gate;

class UpdateDealerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $dealerId = $this->route('dealer');

        return Gate::allows('update', Dealer::findOrFail($dealerId));
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
        ];
    }

    public function forbiddenResponse()
    {
        $error = trans('auth.update', ['noun' => 'dealer']);
        return response(compact('error'));
    }
}
