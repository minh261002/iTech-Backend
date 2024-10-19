<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class ModuleStoreRequest extends BaseRequest
{
    public function methodPost(): array
    {
        return [
            'payload.name' => 'required|unique:modules,name',
            'payload.description' => 'nullable',
            'payload.status' => 'required',
        ];
    }

    public function methodPut(): array
    {
        return [
            'payload.name' => 'required|unique:modules,name,' . $this->id,
            'payload.description' => 'nullable',
            'payload.status' => 'required',
        ];
    }


}