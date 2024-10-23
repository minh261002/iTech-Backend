<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SliderItemRequest;
use App\Http\Requests\Admin\SliderRequest;
use App\Http\Resources\Admin\SliderItemResource;
use App\Http\Resources\Admin\SliderResource;
use App\Repositories\Interfaces\SliderItemRepositoryInterface;
use App\Repositories\Interfaces\SliderRepositoryInterface;
use App\Services\Interfaces\SliderServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class SliderController extends Controller
{
    protected $sliderRepository;
    protected $sliderItemRepository;
    protected $sliderService;

    public function __construct(
        SliderRepositoryInterface $sliderRepository,
        SliderItemRepositoryInterface $sliderItemRepository,
        SliderServiceInterface $sliderService
    ) {
        $this->sliderRepository = $sliderRepository;
        $this->sliderItemRepository = $sliderItemRepository;
        $this->sliderService = $sliderService;
    }

    public function index()
    {
        try {
            $roles = $this->sliderRepository->getOrderBy('id', 'desc');
            return response()->json([
                'status' => 200,
                'message' => 'Lấy danh sách slider thành công',
                'sliders' => SliderResource::collection($roles)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách slider thất bại'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $slider = $this->sliderRepository->find($id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy slider thành công',
                'slider' => new SliderResource($slider)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy slider thất bại'
            ]);
        }
    }

    public function create(SliderRequest $request)
    {
        try {
            $this->sliderService->create($request);
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

    public function update(SliderRequest $request, $id)
    {
        try {
            $this->sliderService->update($request, $id);
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

    public function updateStatus(Request $request, $id)
    {
        try {
            $this->sliderRepository->update($id, $request->only('status'));
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
            $this->sliderRepository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Xóa slider thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Xóa slider thất bại'
            ]);
        }
    }

    public function getSliderItems($slider_id)
    {
        try {
            $slider = $this->sliderRepository->findOrFail($slider_id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy danh sách slider item thành công',
                'sliderItems' => SliderItemResource::collection($slider->items)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy danh sách slider item thất bại'
            ]);
        }
    }

    public function getSliderItem($id)
    {
        try {
            $sliderItem = $this->sliderItemRepository->findOrFail($id);
            return response()->json([
                'status' => 200,
                'message' => 'Lấy slider item thành công',
                'sliderItem' => new SliderItemResource($sliderItem)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Lấy slider item thất bại'
            ]);
        }
    }

    public function createSliderItem(SliderItemRequest $request)
    {
        try {
            $this->sliderService->createSliderItem($request);
            return response()->json([
                'status' => 200,
                'message' => 'Thêm slider item thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Thêm slider item thất bại'
            ]);
        }
    }

    public function updateSliderItem(SliderItemRequest $request, $id)
    {
        try {
            $this->sliderService->updateSliderItem($request, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật slider item thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Cập nhật slider item thất bại'
            ]);
        }
    }

    public function destroySliderItem($id)
    {
        try {
            $this->sliderItemRepository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Xóa slider item thành công'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Xóa slider item thất bại'
            ]);
        }
    }
}
