<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends BaseRequest
{
    public function methodPost()
    {
        return [
            'payload.name' => 'required',
            'payload.email' => 'required|email|unique:admins,email',
            'payload.password' => 'required|min:6',
            'payload.province_id' => 'nullable',
            'payload.district_id' => 'nullable',
            'payload.ward_id' => 'nullable',
            'payload.address' => 'nullable',
            'payload.phone' => 'nullable',
            'payload.image' => 'nullable',
            'payload.birthday' => 'nullable',
            'payload.description' => 'nullable',
            'payload.role_id' => 'required|exists:roles,id',
        ];
    }

    public function methodPut()
    {
        return [
            'payload.name' => 'required',
            'payload.email' => 'required|email|unique:admins,email,' . $this->id,
            'payload.province_id' => 'nullable',
            'payload.district_id' => 'nullable',
            'payload.ward_id' => 'nullable',
            'payload.address' => 'nullable',
            'payload.phone' => 'nullable',
            'payload.image' => 'nullable',
            'payload.birthday' => 'nullable',
            'payload.description' => 'nullable',
            'payload.role_id' => 'required|exists:roles,id',
            'payload.password' => 'nullable|min:6',
        ];
    }
}