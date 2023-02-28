<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestInhouseRequest extends FormRequest
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
            'folio_no' => 'nullable|min:3|max:99',
            'in_date'=> 'nullable|date',
            'out_date'=> 'nullable|date',
            'original_out_date'=> 'nullable|date',
            'no_of_nights'=> 'nullable|numeric|max:9999999',
            'rm_rate'=> 'nullable|numeric',
            'taxes'=> 'nullable|numeric',
            'no_of_pax'=> 'nullable|numeric|max:999999',
            'hotel_note'=> 'nullable|min:3',
            'client_note'=> 'nullable|min:3',
            'way_of_payment'=> 'nullable|min:3|max:49',
            'profile_id'=> 'nullable|exists:guest_profiles,id',
           // 'company_id'=> 'required|exists:companies,id',
            'room_id'=> 'nullable|exists:rooms,id',
            'room_type_id'=> 'nullable|exists:room_types,id',
            'rate_code_id'=> 'nullable|exists:rate_codes,id',
            'market_segment_id'=> 'nullable|exists:markets,id',
            'source_of_business_id'=> 'nullable|exists:businesses,id',
            'meal_id'=> 'nullable|exists:meals,id',
           // 'created_by'=> 'required|exists:users,id',
            'created_inhousGuest_at'=> 'nullable|date',
            'checked_out'=> 'nullable|in:0,1',
            'checkout_by'=> 'nullable|exists:users,id',
            'checkout_at'=> 'nullable|date',
            'is_reservation'=> 'nullable|in:0,1',
            'res_status'=> 'nullable|min:3|max:254',
            'is_group'=> 'nullable|in:0,1',
            'group_code'=> 'nullable|min:3|max:254',
            'is_dummy'=> 'nullable|in:0,1',
            'Is_PM'=> 'nullable|in:0,1',
        ];
    }else{
        return [
            'folio_no' => 'required|min:3|max:99',
            'in_date'=> 'required|date',
            'out_date'=> 'required|date',
            'original_out_date'=> 'required|date',
            'no_of_nights'=> 'required|numeric|max:9999999',
            'rm_rate'=> 'required|numeric',
            'taxes'=> 'required|numeric',
            'no_of_pax'=> 'required|numeric|max:999999',
            'hotel_note'=> 'required|min:3',
            'client_note'=> 'required|min:3',
            'way_of_payment'=> 'required|min:3|max:49',
            'profile_id'=> 'required|exists:guest_profiles,id',
           // 'company_id'=> 'required|exists:companies,id',
            'room_id'=> 'required|exists:rooms,id',
            'room_type_id'=> 'required|exists:room_types,id',
            'rate_code_id'=> 'required|exists:rate_codes,id',
            'market_segment_id'=> 'required|exists:markets,id',
            'source_of_business_id'=> 'required|exists:businesses,id',
            'meal_id'=> 'required|exists:meals,id',
           // 'created_by'=> 'required|exists:users,id',
            'created_inhousGuest_at'=> 'required|date',
            'checked_out'=> 'required|in:0,1',
            'checkout_by'=> 'required|exists:users,id',
            'checkout_at'=> 'required|date',
            'is_reservation'=> 'nullable|in:0,1',
            'res_status'=> 'required|min:3|max:254',
            'is_group'=> 'nullable|in:0,1',
            'group_code'=> 'nullable|min:3|max:254',
            'is_dummy'=> 'nullable|in:0,1',
            'Is_PM'=> 'nullable|in:0,1',
        ];
    }

}
}
