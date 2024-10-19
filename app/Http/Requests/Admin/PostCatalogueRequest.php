<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class PostCatalogueRequest extends BaseRequest
{
    public function methodPost(): array
    {
        return [
            "name" => "required",
            "slug" => "nullable|unique:post_catalogues,slug",
            "parent_id" => "nullable|exists:post_catalogues,id",
            "desc" => "nullable",
            "status" => "required",
            'position' => 'required|integer',
            'image' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ];
    }

    public function methodPut(): array
    {
        return [
            "name" => "required",
            "slug" => "nullable|unique:post_catalogues,slug," . $this->id,
            "parent_id" => "nullable|exists:post_catalogues,id",
            "desc" => "nullable",
            "status" => "required",
            'position' => 'required|integer',
            'image' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ];
    }
}
