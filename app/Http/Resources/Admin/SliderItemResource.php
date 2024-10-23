<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderItemResource extends JsonResource
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
            'slider_id' => $this->slider_id,
            'title' => $this->title,
            'link' => $this->link,
            'position' => $this->position,
            'image' => $this->image,
            'mobile_image' => $this->mobile_image,
        ];
    }
}
