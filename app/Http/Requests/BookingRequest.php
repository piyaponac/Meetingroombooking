<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'booking_date' => 'required',
            'booking_begin' => 'required',
            'booking_end'   => 'required',
            'booking_title' => 'required',
            'booking_num' => 'required',
            'building_id' => 'required',
            'rooms_id' => 'required'
        ];
    }
}
