<?php

namespace App\Services;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Services\Interfaces\PermissionServiceInterface;
use Illuminate\Http\Request;

class PermissionService implements PermissionServiceInterface
{

    protected $repository;

    public function __construct(PermissionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        $data = $request->validated();
        return $this->repository->create($data['payload']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validated();
        return $this->repository->update($id, $data['payload']);
    }
}