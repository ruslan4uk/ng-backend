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
            'language' => json_decode($this->language),
            'contact' => json_decode($this->contact),
            'other_contact' => json_decode($this->other_contact),
            'avatar' => $this->avatar,
            'services' => json_decode($this->services),
            'country' => json_decode($this->country),
            'city' => json_decode($this->city),
            'time_to_call' => json_decode($this->time_to_call),
            'user_files' => json_decode($this->user_files),
            'properties' => json_decode($this->properties),
        ];
    }
}
