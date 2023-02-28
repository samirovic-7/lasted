<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestProfileRequest extends FormRequest
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
            'Profile_no' => 'nullable|min:1|max:100|unique:guest_profiles,Profile_no',
            'first_name' => 'nullable|min:3|max:50',
            'last_name' => 'nullable|min:3|max:50',
            'id_no' => 'nullable|min:1|max:100|unique:guest_profiles,id_no',
            'mobile' => 'nullable|min:3|max:50',
            'phone' => 'nullable|min:3|max:50',
            'email' => 'nullable|email|min:3|max:50',
            'address' => 'nullable|min:3|max:254',
            'city' => 'nullable|min:3|max:254',
            'language' => 'nullable|min:2|max:2',
            'date_of_birth' => 'nullable|date',
            'gender' =>'nullable|in:male,femal',
            'created_by' => 'nullable|min:3|max:254',
            'country_id' => 'nullable|exists:countries,id',
        ];
    }else{
        return [
            'Profile_no' => 'required|min:1|max:100|unique:guest_profiles,Profile_no',
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'id_no' => 'required|min:1|max:100|unique:guest_profiles,id_no',
            'mobile' => 'required|min:3|max:50',
            'phone' => 'required|min:3|max:50',
            'email' => 'required|email|min:3|max:50',
            'address' => 'required|min:3|max:254',
            'city' => 'required|min:3|max:254',
            'language' => 'required|min:2|max:2',
            'date_of_birth' => 'required|date',
            'gender' =>'required|in:male,femal',
            'created_by' => 'required|min:3|max:254',
            'country_id' => 'required|exists:countries,id',
        ];

    }
    }
}
