<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberStoreRequest;
use App\Http\Resources\Admin\MemberResource;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Services\Interfaces\MemberServiceInterface;
use Illuminate\Http\Request;
use Log;

class MemberController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(
        MemberRepositoryInterface $repository,
        MemberServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        try {
            $members = $this->repository->getOrderBy('id', 'desc');
            return response()->json([
                'status' => 200,
                'members' => MemberResource::collection($members)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách thành viên thất bại'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $member = $this->repository->find($id);
            return response()->json([
                'status' => 200,
                'member' => new MemberResource($member)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy thông tin thành viên thất bại'
            ]);
        }
    }

    public function create(MemberStoreRequest $request)
    {
        try {
            $this->service->create($request);
            return response()->json([
                'status' => 200,
                'message' => 'Thêm thành viên mới thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Thêm thành viên mới thất bại'
            ]);
        }
    }

    public function update($id, MemberStoreRequest $request)
    {
        try {
            $this->service->update($request, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật thông tin thành viên thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật thông tin thành viên thất bại'
            ]);
        }
    }

    public function updateStatus($id, Request $request)
    {
        try {
            $this->service->updateStatus($id, $request);
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật trạng thái thành viên thất bại'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Xóa thành viên thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Xóa thành viên thất bại'
            ]);
        }
    }
}