<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    public function getDistricts($province_code)
    {
        $districts = District::where('parent_code', $province_code)->get();
        return response()->json($districts);
    }

    public function getWards($district_code)
    {
        $wards = Ward::where('parent_code', $district_code)->get();
        return response()->json($wards);
    }
}
