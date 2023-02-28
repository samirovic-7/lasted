<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UseractivityResource extends JsonResource
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
            'description' => $this->description,
            'date' => $this->created_at->format('Y-m-d H:i:s'),
            'causer'=>$this->causer_type::where('id',$this->causer_id)->get(),
            'properties'=> $this->properties,
        ];
    }
}
