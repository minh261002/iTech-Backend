<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class PostRequest extends BaseRequest
{
    public function methodPost()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'catalogueId' => 'required',
            'image' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ];
    }

    public function methodPut()
    {
        return [
            'title' => 'required|unique:posts,title,' . $this->id,
            'content' => 'required',
            'status' => 'required',
            'image' => 'nullable',
            'is_featured' => 'required',
            'catalogueId' => 'required',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ];
    }

}