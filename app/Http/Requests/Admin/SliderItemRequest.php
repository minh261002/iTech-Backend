<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class SliderItemRequest extends BaseRequest
{
    public function methodPost()
    {
        return [
            'slider_id' => 'required|exists:sliders,id',
            'title' => 'required',
            'link' => 'nullable',
            'position' => 'required',
            'image' => 'required',
            'mobile_image' => 'nullable',
        ];
    }

    public function methodPut()
    {
        return [
            'slider_id' => 'required|exists:sliders,id',
            'title' => 'required',
            'link' => 'nullable',
            'position' => 'required',
            'image' => 'required',
            'mobile_image' => 'nullable',
        ];
    }
}