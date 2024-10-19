<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ModuleStoreRequest;
use App\Http\Resources\Admin\ModuleResource;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use App\Services\Interfaces\ModuleServiceInterface;
use Illuminate\Http\Request;
use Log;

class ModuleController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(
        ModuleServiceInterface $service,
        ModuleRepositoryInterface $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $modules = $this->repository->getOrderBy('id', 'desc');
            return response()->json([
                'status' => 200,
                'message' => 'Lấy danh sách module thành công',
                'modules' => ModuleResource::collection($modules)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách module thất bại'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $module = $this->repository->findOrFail($id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy module thành công',
                'module' => new ModuleResource($module)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy module thất bại'
            ]);
        }
    }

    public function update(ModuleStoreRequest $request, $id)
    {
        try {
            $this->service->update($request, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật module thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật module thất bại'
            ]);
        }
    }

    public function create(ModuleStoreRequest $request)
    {
        try {
            $this->service->create($request);
            return response()->json([
                'status' => 200,
                'message' => 'Thêm mới module thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Thêm mới module thất bại'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Xóa module thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Xóa module thất bại'
            ]);
        }
    }
}