<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Resources\Admin\AdminInfoResource;
use App\Http\Resources\Admin\AdminListResource;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Services\Interfaces\AdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;

class AdminController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(
        AdminRepositoryInterface $repository,
        AdminServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        try {
            $admins = $this->repository->getOrderBy('id', 'desc');
            $admins = $admins->filter(function ($admin) {
                return $admin->id != auth('admin')->user()->id;
            });
            return response()->json([
                'status' => 200,
                'message' => 'Lấy danh sách admin thành công',
                'admins' => AdminListResource::collection($admins)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách admin thất bại',
            ]);
        }
    }
    public function show($id)
    {
        try {
            $module = $this->repository->find($id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy thông tin admin thành công',
                'admin' => new AdminInfoResource($module)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy thông tin admin thất bại',
            ]);
        }
    }

    public function create(AdminStoreRequest $request)
    {
        try {
            $this->service->create($request);
            return response()->json([
                'status' => 200,
                'message' => 'Admin created successfully',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(AdminStoreRequest $request, $id)
    {
        try {
            $this->service->update($request, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Admin updated successfully',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Admin deleted successfully',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}