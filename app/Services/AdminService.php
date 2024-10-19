<?php

namespace App\Services;


use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Services\Interfaces\AdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminService implements AdminServiceInterface
{
    protected $repository;

    public function __construct(AdminRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        $data = $request->validated();
        $role = $data['payload']['role_id'];
        $data['payload']['image'] = $data['payload']['image'] ?? 'https://i0.wp.com/sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png?ssl=1';
        unset($data['payload']['role_id']);
        $data['password'] = Hash::make($data['payload']['password']);

        if ($data['payload']['birthday']) {
            $data['payload']['birthday'] = date('Y-m-d', strtotime($data['payload']['birthday']));
        }


        $admin = $this->repository->create($data['payload']);

        $admin->roles()->attach($role);

        return $admin;
    }

    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $role = $data['payload']['role_id'];
        $data['payload']['image'] = $data['payload']['image'] ?? 'https://i0.wp.com/sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png?ssl=1';
        unset($data['payload']['role_id']);

        if ($data['payload']['password']) {
            $data['payload']['password'] = Hash::make($data['payload']['password']);
        } else {
            unset($data['payload']['password']);
        }

        if ($data['payload']['birthday']) {
            $data['payload']['birthday'] = date('Y-m-d', strtotime($data['payload']['birthday']));
        }

        $admin = $this->repository->update($id, $data['payload']);

        $admin->roles()->sync($role);

        return $admin;
    }

}