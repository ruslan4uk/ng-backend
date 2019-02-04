<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserData extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'about' => $this->about,
            'language' => $this->language,
            'contact' => $this->contact,
            'other_contact' => $this->other_contact,
            'avatar' => $this->avatar,
            'services' => $this->services,
            'country' => $this->country,
            'city' => $this->city,
            'time_to_call' => $this->time_to_call
        ];
    }
}
