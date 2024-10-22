<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(
        CategoryServiceInterface $service,
        CategoryRepositoryInterface $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            $modules = $this->repository->getFlatTree();
            return response()->json([
                'status' => 200,
                'message' => 'Lấy danh sách dah mục thành công',
                'postCatalogues' => CategoryResource::collection($modules)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách dah mục thất bại',
            ]);
        }
    }

    public function create(CategoryRequest $request)
    {
        try {
            $this->service->create($request);
            return response()->json([
                'status' => 200,
                'message' => 'Thêm dah mục thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Thêm dah mục thất bại'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $module = $this->repository->find($id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy thông tin dah mục thành công',
                'postCatalogue' => new CategoryResource($module)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy thông tin dah mục thất bại'
            ]);
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $this->service->update($request, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật dah mục thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật dah mục thất bại'
            ]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $this->repository->update($id, $request->only('status'));
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật trạng thái dah mục thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật trạng thái dah mục thất bại'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Xóa dah mục thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Xóa dah mục thất bại'
            ]);
        }
    }
}
