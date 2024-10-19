<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class MemberStoreRequest extends BaseRequest
{
    public function methodPost()
    {
        return [
            'payload.name' => 'required|string',
            'payload.username' => 'required|string|unique:users,username',
            'payload.email' => 'required|email|unique:users,email',
            'payload.phone' => 'nullable',
            'payload.birthday' => 'nullable',
            'payload.description' => 'nullable',
            'payload.province_id' => 'nullable',
            'payload.district_id' => 'nullable',
            'payload.ward_id' => 'nullable',
            'payload.address' => 'nullable',
            'payload.password' => 'required|string|min:6',
            'payload.status' => 'required',
            'payload.image' => 'nullable',
        ];
    }

    public function methodPut(){
        return [
            'payload.name' => 'required|string',
            'payload.username' => 'required|string|unique:users,username,' . $this->id,
            'payload.email' => 'required|email|unique:users,email,' . $this->id,
            'payload.phone' => 'nullable',
            'payload.birthday' => 'nullable',
            'payload.description' => 'nullable',
            'payload.province_id' => 'nullable',
            'payload.district_id' => 'nullable',
            'payload.ward_id' => 'nullable',
            'payload.address' => 'nullable',
            'payload.status' => 'required',
            'payload.image' => 'nullable',
            'payload.password' => 'nullable',
        ];
    }
}