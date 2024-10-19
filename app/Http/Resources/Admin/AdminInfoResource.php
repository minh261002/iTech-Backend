<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AdminInfoResource extends JsonResource
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
            'email' => $this->email,
            'image' => $this->image,
            'phone' => $this->phone,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'ward_id' => $this->ward_id,
            'address' => $this->address,
            'birthday' => $this->birthday,
            'description' => $this->description,
            'roles' => $this->role->map(function ($role) {
                return [
                    'id' => $role->id,
                    'title' => $role->title,
                ];
            }),
        ];
    }
}
