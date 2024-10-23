<?php

namespace App\Services;

use App\Repositories\Interfaces\SliderItemRepositoryInterface;
use App\Repositories\Interfaces\SliderRepositoryInterface;
use App\Services\Interfaces\SliderServiceInterface;
use Illuminate\Http\Request;

class SliderService implements SliderServiceInterface
{
    protected $sliderRepository;
    protected $sliderItemRepository;

    public function __construct(
        SliderRepositoryInterface $sliderRepository,
        SliderItemRepositoryInterface $sliderItemRepository
    ) {
        $this->sliderRepository = $sliderRepository;
        $this->sliderItemRepository = $sliderItemRepository;
    }

    public function create(Request $request)
    {
        $data = $request->validated();

        return $this->sliderRepository->create($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validated();

        return $this->sliderRepository->update($id, $data);
    }

    public function createSliderItem(Request $request)
    {
        $data = $request->validated();

        return $this->sliderItemRepository->create($data);
    }

    public function updateSliderItem(Request $request, $id)
    {
        $data = $request->validated();

        return $this->sliderItemRepository->update($id, $data);
    }
}