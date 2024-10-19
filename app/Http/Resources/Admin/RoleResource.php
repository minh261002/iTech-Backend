<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'title' => $this->title,
            'name' => $this->name,
            'guard_name' => $this->guard_name,
            'permissions' => $this->permissions->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'name' => $item->name,
                    'guard_name' => $item->guard_name,
                    // 'module_id' => new ModuleResource($item->module),
                ];
            }),
        ];
    }
}