<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionStoreRequest;
use App\Http\Resources\Admin\PermissionResource;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Services\Interfaces\PermissionServiceInterface;
use Illuminate\Http\Request;
use Log;

class PermissionController extends Controller
{

    protected $service;
    protected $repository;

    public function __construct(
        PermissionServiceInterface $service,
        PermissionRepositoryInterface $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            $permissions = $this->repository->getOrderBy('id', 'desc');
            return response()->json([
                'status' => 200,
                'message' => 'Lấy danh sách quyền thành công',
                'permissions' => PermissionResource::collection($permissions)
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách quyền thất bại'
            ], 500);
        }
    }

    public function create(PermissionStoreRequest $request)
    {
        try {
            $this->service->create($request);
            return response()->json([
                'status' => 200,
                'message' => 'Thêm mới quyền thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Thêm mới quyền thất bại'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $permission = $this->repository->findOrFail($id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy quyền thành công',
                'permission' => new PermissionResource($permission)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy quyền thất bại'
            ]);
        }
    }

    public function update(PermissionStoreRequest $request, $id)
    {
        try {
            $this->service->update($request, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật quyền thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật quyền thất bại'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Xóa quyền thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Xóa quyền thất bại'
            ]);
        }
    }
}
