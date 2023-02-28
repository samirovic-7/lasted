<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules() 
    {
        if( (in_array($this->method(), ['PUT', 'PATCH']))){
    
            return [
               
                'room_name_en' => 'nullable|unique:rooms,rm_name_en|max:254',
                'room_name_loc' => 'nullable|unique:rooms,rm_name_loc|max:254',
                'room_max_pax' => 'nullable|numeric',
                'room_phone_no' => 'nullable',
                'room_phone_ext' => 'nullable',
                'room_key_code' => 'nullable|min:3|max:254',
                'room_key_options' => 'nullable|min:3|max:254',
                'room_connection' => 'nullable|boolean',
                'fo_status' => 'nullable|min:1|max:254',
                'room_active' => 'nullable|boolean',
                'hk_stauts' => 'nullable|min:1|max:254',
                'sort_order' => 'nullable|numeric',
                'room_type_id' => 'nullable|exists:room_types,id',
                'floor_id' => 'nullable|exists:room_types,id',
              
            ];
        }else{
            return [
                'room_name_en' => 'required|unique:rooms,rm_name_en|max:254',
                'room_name_loc' => 'nullable|unique:rooms,rm_name_loc|max:254',
                'room_max_pax' => 'nullable|numeric',
                'room_phone_no' => 'nullable',
                'room_phone_ext' => 'nullable',
                'room_key_code' => 'nullable|min:3|max:254',
                'room_key_options' => 'nullable|min:3|max:254',
                'room_connection' => 'nullable|boolean',
                'fo_status' => 'nullable|min:2|max:4',
                'room_active' => 'nullable|boolean',
                'hk_stauts' => 'nullable|min:2|max:4',
                'sort_order' => 'nullable|numeric', 
                'room_type_id' => 'required|exists:room_types,id',
                'floor_id' => 'required|exists:room_types,id',

            ];
        }
    }
}
