<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;


class RoleStoreRequest extends BaseRequest
{
    public function methodPost(): array
    {
        return [
            'payload.title' => 'required',
            'payload.name' => 'required|unique:permissions,name',
            'payload.guard_name' => 'required',
            'payload.permissions' => 'required|array',
        ];
    }

    public function methodPut(): array
    {
        return [
            'payload.title' => 'required',
            'payload.name' => 'required|unique:permissions,name,' . $this->id,
            'payload.guard_name' => 'required',
            'payload.permissions' => 'required|array',
        ];
    }
}