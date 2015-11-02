<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PropertyRequest extends Request
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
            'street'        => 'required|max:256',
            'city'          => 'required|max:256',
            'zip'           => 'required|max:256',
            'state'         => 'required|max:256',
            'country'       => 'required|max:256',
            'price'         => 'required|max:50',
            'teaser'        => 'max:140',
            'description'   => 'required|max:400',
            'g-recaptcha-response' => 'required|recaptcha'
        ];
    }
}
