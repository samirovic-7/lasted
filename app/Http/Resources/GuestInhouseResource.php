<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuestInhouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
        'id' => $this->id,
        'folio_no' => $this->folio_no,
        'in_date' => $this->in_date,
        'out_date' => $this->out_date,
        'original_out_date' => $this->original_out_date,
        'no_of_nights' => $this->no_of_nights,
        'rm_rate' => $this->rm_rate,
        'taxes' => $this->taxes,
        'no_of_pax' => $this->no_of_pax,
        'hotel_note' => $this->hotel_note,
        'client_note' => $this->client_note,
        'way_of_payment' => $this->way_of_payment,
        'profile_id' => $this->profile,
       // 'company_id' => $this->company,
        'room_id' => $this->room,
        'room_type_id' => $this->roomTybe,
        'rate_code_id' => $this->rateCode,
        'market_segment_id' => $this->marketSegment,
        'source_of_business_id' => $this->sourceBusiness,
        'meal_id' => $this->meal,
        'created_by' => $this->createdBy,
        'created_inhousGuest_at' => $this->created_inhousGuest_at,
        'checked_out' => $this->checked_out,
        'checkout_by' => $this->checkout_by,
        'checkout_at' => $this->checkout_at,
        'is_reservation' => $this->is_reservation,
        'res_status' => $this->res_status,
        'is_group' => $this->is_group,
        'group_code' => $this->group_code,
        'is_dummy' => $this->is_dummy,
        'Is_PM' => $this->Is_PM,
        ];
    }
}
