<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\BaseRequest;

class PermissionStoreRequest extends BaseRequest
{
    public function methodPost(): array
    {
        return [
            'payload.title' => 'required',
            'payload.name' => 'required|unique:permissions,name',
            'payload.guard_name' => 'required',
            'payload.module_id' => 'required',
        ];
    }

    public function methodPut(): array
    {
        return [
            'payload.title' => 'required',
            'payload.name' => 'required|unique:permissions,name,' . $this->id,
            'payload.guard_name' => 'required',
            'payload.module_id' => 'required',
        ];
    }
}