<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuildingRequest extends FormRequest
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
            'buildings_name' => 'required|unique:buildings',
            'status' => 'required',
            
        ];
    }
    public function messages()
    {
        return [
            'buildings_name.required' => 'กรุณากรอกข้อมูลอาคาร',
            'status.required' => 'กรุณาเลือกข้อมูลสถานะ'
        ];
    }
}
