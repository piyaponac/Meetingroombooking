<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$this->route('user'),
            'email' => 'required|unique:users,email,'.$this->route('user'),
           
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ชื่อไม่สามารถเป็นค่าว่างได้',
            'username.required' => 'username ไม่สามารถเป็นค่าว่างได้',
            'username.unique' => 'username นี้มีในระบบแล้ว',
            'email.required' => 'email ไม่สามารถเป็นค่าว่างได้',
            'email.unique' => 'email นี้มีอยู่ในระบบแล้ว'
        ];
    }
}
