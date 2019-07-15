<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Room;
use App\User_room;

class RoomMeetingCreateRequest extends FormRequest
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
            'rooms_name' => 'required|unique:rooms',
            'rooms_size' => 'required',
            'building_id' => 'required',
            'users_room' => 'required',
            'building_floor' => 'required',
            'rooms_detail' => '',
            'rooms_equipment' => '',
            'rooms_status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'rooms_name.required' => 'กรุณากรอกข้อมูลชื่อห้องประชุม',
            'rooms_name.unique' => 'ชื่อห้องประชุมมีในระบบอยู่แล้ว',
            'rooms_size.required' => 'กรุณากรอกข้อมูลความจุห้อง',
            'rooms_detail.required' => '',
            'rooms_status.required' => 'กรุณาเลือกข้อมูลสถานะ'
        ];
    }
}
