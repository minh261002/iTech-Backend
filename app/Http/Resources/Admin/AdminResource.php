<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AdminResource extends JsonResource
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
            'address' => $this->address,
            'roles' => $this->role->map(function ($role) {
                return [
                    'id' => $role->id,
                    'title' => $role->title,
                ];
            }),
            'permissions' => $this->role->map(function ($role) {
                return $role->permissions->map(function ($permission) {
                    return [
                        'id' => $permission->id,
                        'name' => $permission->name,
                    ];
                });
            }),
        ];
    }
}