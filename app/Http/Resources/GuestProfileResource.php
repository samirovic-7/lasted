<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuestProfileResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'id_number' => $this->id_no,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'language' => $this->language,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'created_by' => $this->created_by,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'country' => $this->country_id,
            
        ];
    }
}
