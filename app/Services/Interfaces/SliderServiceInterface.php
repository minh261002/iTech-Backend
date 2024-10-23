<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface SliderServiceInterface
{
    public function create(Request $request);

    public function update(Request $request, $id);

    public function createSliderItem(Request $request);

    public function updateSliderItem(Request $request, $id);
}
