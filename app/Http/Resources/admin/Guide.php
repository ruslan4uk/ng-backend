<?php

namespace App\Http\Resources\admin;

use App\UserData;
use App\Http\Resources\admin\UserData as UserDataResource;

use Illuminate\Http\Resources\Json\JsonResource;

class Guide extends JsonResource
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
            'name' => $this->name,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'data' => UserDataResource::collection(UserData::all())
        ];
    }
}