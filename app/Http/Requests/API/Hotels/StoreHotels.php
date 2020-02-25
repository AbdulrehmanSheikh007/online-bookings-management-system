<?php

namespace App\Http\Requests\API\Hotels;

use App\Http\Requests\API\BaseFormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class StoreHotels extends BaseFormRequest {

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
        $validate = [
            'action' => "required",
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

        return $validate;
    }

}
