<?php

namespace App\Http\Resources\Rooms;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'room_id' => $this->id,
            'room_name_en' => $this->rm_name_en,
            'room_name_loc' => $this->rm_name_loc,
            'room_max_pax' => $this->rm_max_pax,
            'room_phone_no' => $this->rm_phone_no,
            'room_phone_ext' => $this->rm_phone_ext,
            'room_key_code' => $this->rm_key_code,
            'room_key_options' => $this->rm_key_options,
            'room_connection' => $this->rm_connection,
            'fo_status' => $this->fo_status,
            'room_active' => $this->rm_active,
            'hk_stauts' => $this->hk_stauts,
            'sort_order' => $this->sort_order,
            'roomType' => $this->room_tybe,
            'floors' => $this->floors,
            
        ];
    }
}
