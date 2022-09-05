<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id_no' => $this->id_no,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'position' => $this->position,
        ];
    }
}
