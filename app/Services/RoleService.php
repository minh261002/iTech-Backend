<?php

namespace App\Services;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Services\Interfaces\RoleServiceInterface;

class RoleService implements RoleServiceInterface
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function create($request)
    {
        $data = $request->validated();

        $permissions = $data['payload']['permissions'];
        unset($data['payload']['permissions']);
        $role = $this->roleRepository->create($data['payload']);

        $role->permissions()->sync($permissions);

        return $role;
    }

    public function update($request, $id)
    {
        $data = $request->validated();

        $permissions = $data['payload']['permissions'];
        unset($data['payload']['permissions']);
        $role = $this->roleRepository->update($id, $data['payload']);

        $role->permissions()->sync($permissions);

        return $role;
    }
}