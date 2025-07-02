<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\District;
use App\Models\Locality;
use App\Models\Region;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //
    public function getProvinces($region_id){
        return Province::where('region_id', $region_id)->select('id', 'province_name')->get();
    }
    public function getDistricts($province_id) {
        return District::where('province_id', $province_id)->select('id', 'district_name')->get();
    }
    
    public function getLocalities($district_id) {
        return Locality::where('district_id', $district_id)->select('id', 'locality_name')->get();
    }
}
