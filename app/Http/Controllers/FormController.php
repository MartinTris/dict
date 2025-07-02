<?php

namespace App\Http\Controllers;
use App\Models\Region;
use App\Models\District;
use App\Models\Locality;
use Illuminate\Http\Request;

class FormController extends Controller
{
    //
    public function getRegion(){
        $regions = Region::all();
        return view('form-test',compact('regions'));
    }

    public function storeDistrict(Request $request)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'district_name' => 'required|string|max:255|unique:districts,district_name'
        ]);

        $district = District::create([
            'province_id' => $request->province_id,
            'district_name' => $request->district_name,
        ]);

        return response()->json($district);
    }

    public function storeLocality(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'locality_name' => 'required|string|max:255|unique:localities,locality_name'
        ]);

        $locality = Locality::create([
            'district_id' => $request->district_id,
            'locality_name' => $request->locality_name,
        ]);

        return response()->json($locality);
    }
}
