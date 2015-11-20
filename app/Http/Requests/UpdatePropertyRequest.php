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
            'street'            => ['required','max:255', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'city'              => 'required|max:255',
            'zip'               => ['required','max:255', 'regex:/(^[A-Za-z0-9 \-]+$)+/'],
            'state'             => 'required|max:255',
            'country'           => 'required|max:2',
            'price'             => 'integer',
            'description'       => 'required|max:400',
            'bedrooms'          => 'required',
            'bathrooms'         => 'required',
            'size_square_feet'  => 'numeric',
            'contact_email'     => 'email',
            'transaction_type'  => 'required',
            'seller_type'       => 'required',
            'property_type'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'street.regex' => "Street can only contain letters, numbers and space",
            'zip.regex'     => "Zip can only contain letters, numbers, space and hyphen"
        ];
    }
}
