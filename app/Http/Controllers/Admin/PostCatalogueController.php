<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCatalogueRequest;
use App\Http\Resources\Admin\PostCatalogueResource;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface;
use App\Services\Interfaces\PostCatalogueServiceInterface;
use Illuminate\Http\Request;
use Log;

class PostCatalogueController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(
        PostCatalogueServiceInterface $service,
        PostCatalogueRepositoryInterface $repository
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
                'message' => 'Lấy danh sách chuyên mục bài viết thành công',
                'postCatalogues' => PostCatalogueResource::collection($modules)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách chuyên mục bài viết thất bại',
            ]);
        }
    }

    public function create(PostCatalogueRequest $request)
    {
        try {
            $this->service->create($request);
            return response()->json([
                'status' => 200,
                'message' => 'Thêm chuyên mục bài viết thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Thêm chuyên mục bài viết thất bại'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $module = $this->repository->find($id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy thông tin chuyên mục bài viết thành công',
                'postCatalogue' => new PostCatalogueResource($module)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy thông tin chuyên mục bài viết thất bại'
            ]);
        }
    }

    public function update(PostCatalogueRequest $request, $id)
    {
        try {
            $this->service->update($request, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật chuyên mục bài viết thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật chuyên mục bài viết thất bại'
            ]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $this->repository->update($id, $request->only('status'));
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật trạng thái chuyên mục bài viết thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật trạng thái chuyên mục bài viết thất bại'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Xóa chuyên mục bài viết thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Xóa chuyên mục bài viết thất bại'
            ]);
        }
    }
}
