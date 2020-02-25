<?php

namespace App\Http\Requests\API\Bookings;

use App\Http\Requests\API\BaseFormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class StoreBookings extends BaseFormRequest {

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
            'hotel_id' => "required",
            'first_name' => "required",
            'last_name' => "required",
            'email' => "required|email",
            'cnic' => "numeric",
            'ntn' => "required",
            'phone' => "required|numeric",
            'booking_duration' => "required",
            'adults' => "required|numeric",
            'children' => "required|numeric",
            'total' => "required|numeric",
            'advance' => "numeric",
        ];
        
        return $validate;
    }

}
