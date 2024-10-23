<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class SliderRequest extends BaseRequest
{
    public function methodPost()
    {
        return [
            'name' => 'required',
            'desc' => 'nullable',
            'status' => 'required',
        ];
    }

    public function methodPut()
    {
        return [
            'name' => 'required|unique:sliders,name,' . $this->id,
            'desc' => 'nullable',
            'status' => 'required',
        ];
    }
}