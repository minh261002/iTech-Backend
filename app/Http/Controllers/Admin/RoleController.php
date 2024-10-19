<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Resources\Admin\ModulePermissionResource;
use App\Http\Resources\Admin\RoleResource;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Services\Interfaces\RoleServiceInterface;
use Illuminate\Http\Request;
use Log;

class RoleController extends Controller
{
    protected $repository;

    protected $service;

    public function __construct(
        RoleServiceInterface $service,
        RoleRepositoryInterface $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            $roles = $this->repository->getOrderBy('id', 'desc');
            return response()->json([
                'status' => 200,
                'message' => 'Lấy danh sách vai trò thành công',
                'roles' => RoleResource::collection($roles)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách vai trò thất bại'
            ]);
        }
    }

    public function getModules()
    {
        $modules = $this->repository->getAllPermissionsInAllModules();
        return response()->json([
            'status' => 200,
            'message' => 'Lấy danh sách module thành công',
            'modules' => ModulePermissionResource::collection($modules)
        ]);
    }

    public function create(RoleStoreRequest $request)
    {
        try {
            $this->service->create($request);
            return response()->json([
                'status' => 200,
                'message' => 'Thêm vai trò thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Thêm vai trò thất bại'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $role = $this->repository->find($id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy vai trò thành công',
                'role' => new RoleResource($role)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy vai trò thất bại'
            ]);
        }
    }

    public function update(RoleStoreRequest $request, $id)
    {
        try {
            $this->service->update($request, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật vai trò thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật vai trò thất bại'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Xóa vai trò thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Xóa vai trò thất bại'
            ]);
        }
    }
}