<?php

namespace App\Http\Requests\Hotel;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email'
            ],
            'contact_first_name' => 'required',
            'contact_last_name' => 'required',
            'contact_number_1' => 'required|numeric',
            'contact_number_2' => 'numeric',
            'contact_email' => 'required|email',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'website_uri' => 'required'
        ];
    }

}
