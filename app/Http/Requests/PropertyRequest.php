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
            'street'        => 'required|max:255|alpha_num',
            'city'          => 'required|max:255',
            'zip'           => 'required|max:255|alpha_num',
            'state'         => 'required|max:255',
            'country'       => 'required|max:2',
            'price'         => 'max:50',
            'description'   => 'required|max:400',
            'bedrooms'      => 'required',
            'bathrooms'     => 'required',
            'size_square_feet'  => 'integer',
            'contact_email'     => 'email',
            'transaction_type'  => 'required',
            'seller_type'       => 'required',
            'property_type'     => 'required',
            'g-recaptcha-response' => 'required|recaptcha'
        ];
    }
}
