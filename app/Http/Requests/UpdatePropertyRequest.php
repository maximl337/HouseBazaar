<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePropertyRequest extends Request
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
            'street'        => 'required|max:100',
            'city'          => 'required|max:100',
            'zip'           => 'required|max:100',
            'state'         => 'required|max:100',
            'country'       => 'required|max:2',
            'price'         => 'required|max:50',
            'teaser'        => 'max:140',
            'description'   => 'required|max:400'
        ];
    }
}
