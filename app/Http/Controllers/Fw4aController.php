<?php

namespace App\Http\Controllers;

use App\Models\Fw4a;
use App\Models\Region;
use Illuminate\Http\Request;

class Fw4aController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Fw4a::with(['region', 'province', 'district', 'locality']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('site_code', 'like', "%$search%")
                  ->orWhere('ap_mac_address', 'like', "%$search%")
                  ->orWhere('site_name', 'like', "%$search%")
                  ->orWhere('contractor', 'like', "%$search%")
                  ->orWhere('contract_status', 'like', "%$search%");
        
                // Search related district name
                  $q->orWhereHas('district', function ($q2) use ($search) {
                    $q2->where('district_name', 'like', "%$search%");
                });
        
                // Search related locality name
                $q->orWhereHas('locality', function ($q2) use ($search) {
                    $q2->where('locality_name', 'like', "%$search%");
                });
            });
        }
    
        $fw4as = $query->paginate(10)->withQueryString(); 
        $regions = Region::all();
        return view('connect.fw4a.fw4a', compact('fw4as','regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_code'       => 'required|string',
            'ap_mac_address'  => 'nullable|string|unique:fw4a_sites,ap_mac_address',
            'site_name'       => 'required|string',
            'region_id'       => 'required|exists:regions,id',
            'province_id'     => 'required|exists:provinces,id',
            'district_id'     => 'required|exists:districts,id',
            'locality_id'     => 'required|exists:localities,id',
            'contract_status' => 'nullable|string',
            'contract'     => 'nullable|string',
            'category'     => 'nullable|string',
            'contractor'   => 'nullable|string',
            'latitude'        => 'nullable|string',
            'longitude'       => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);
    
        Fw4a::create($validated);
    
        return redirect()->back()->with('success', 'Site has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fw4a $fw4a)
    {
        $regions = Region::all();
        $fw4a->load(['region', 'province', 'district', 'locality']);
        return view('connect.fw4a.show', compact('fw4a', 'regions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fw4a $fw4a)
    {
        $fw4a->load(['region', 'province', 'district', 'locality']);
        return view('connect.fw4a.edit', compact('fw4a'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fw4a $fw4a)
    {
        $validated = $request->validate([
            'site_code'       => 'required|string',
            'ap_mac_address'  => 'nullable|string|unique:fw4a_sites,ap_mac_address,' . $fw4a->id,
            'site_name'       => 'required|string',
            'region_id'       => 'required|exists:regions,id',
            'province_id'     => 'required|exists:provinces,id',
            'district_id'     => 'required|exists:districts,id',
            'locality_id'     => 'required|exists:localities,id',
            'contract_status' => 'nullable|string',
            'contract'        => 'nullable|string',
            'category'        => 'nullable|string',
            'contractor'      => 'nullable|string',
            'latitude'        => 'nullable|string',
            'longitude'       => 'nullable|string',
            'user_id'         => 'required|exists:users,id',
        ]);

        $fw4a->update($validated);

        return redirect()->back()->with('success', 'Site has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fw4a $fw4a)
    {
        $fw4a->delete();
        return redirect()->back()->with('success', 'Site has been successfully deleted.');
    }
}
