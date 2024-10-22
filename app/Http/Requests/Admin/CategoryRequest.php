<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class CategoryRequest extends BaseRequest
{
    public function methodPost(): array
    {
        return [
            "name" => "required",
            "slug" => "nullable|unique:categories,slug",
            "parent_id" => "nullable|exists:categories,id",
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
            "slug" => "nullable|unique:categories,slug," . $this->id,
            "parent_id" => "nullable|exists:categories,id",
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
