<?php

namespace App\Services;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use App\Services\Interfaces\ModuleServiceInterface;
use Illuminate\Http\Request;

class ModuleService implements ModuleServiceInterface
{
    protected $repository;

    public function __construct(ModuleRepositoryInterface $repository)
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