<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Http\Resources\Admin\PostResource;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Services\Interfaces\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    protected $repository;

    protected $service;

    public function __construct(
        PostServiceInterface $service,
        PostRepositoryInterface $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            $modules = $this->repository->getOrderBy('id', 'desc');
            return response()->json([
                'status' => 200,
                'message' => 'Lấy danh sách bài viết thành công',
                'posts' => PostResource::collection($modules)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách bài viết thất bại',
            ]);
        }
    }

    public function create(PostRequest $request)
    {
        try {
            $this->service->create($request);
            return response()->json([
                'status' => 200,
                'message' => 'Thêm bài viết thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Thêm bài viết thất bại'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $module = $this->repository->find($id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy thông tin bài viết thành công',
                'post' => new PostResource($module)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy thông tin bài viết thất bại'
            ]);
        }
    }

    public function update(PostRequest $request, $id)
    {
        try {
            $this->service->update($request, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật bài viết thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật bài viết thất bại'
            ]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $this->repository->update($id, $request->only('status'));
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật trạng thái bài viết thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật trạng thái bài viết thất bại'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $post = $this->repository->findOrFail($id);
            $post->catalogues()->detach();
            $post->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Xóa bài viết thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Xóa bài viết thất bại'
            ]);
        }
    }
}