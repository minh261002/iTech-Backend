<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
        'id' => $this->id,
        'name' => $this->name,
        'username' => $this->username,
        'email' => $this->email,
        'image' => $this->image,
        'phone' => $this->phone,
        'province_id' => $this->province_id,
        'district_id' => $this->district_id,
        'ward_id' => $this->ward_id,
        'address' => $this->address,
        'birthday' => $this->birthday,
        'description' => $this->description,
        'status' => $this->status,
        'is_google' => $this->is_google,
        'is_facebook' => $this->is_facebook,
       ];
    }
}