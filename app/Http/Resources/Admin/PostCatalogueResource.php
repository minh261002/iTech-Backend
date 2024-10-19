<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCatalogueResource extends JsonResource
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
            'depth' => $this->depth,
            '_lft' => $this->_lft,
            '_rgt' => $this->_rgt,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'image' => $this->image,
            'slug' => $this->slug,
            'position' => $this->position,
            'status' => $this->status,
            'desc' => $this->desc,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keyword' => $this->meta_keyword,
        ];
    }
}