<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Fw4a;
use App\Models\Region;
use App\Models\Contract;
use App\Models\Contractor;
use Illuminate\Http\Request;

class Fw4aController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fw4as = Fw4a::all();
        $regions = Region::all();
        $contracts = Contract::all();
        $categories = Category::all();
        $contractors = Contractor::all();
        return view('connect.fw4a.fw4a', compact('fw4as','regions', 'contracts', 'categories', 'contractors'));
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
            'site_code'       => 'required|string|unique:fw4a_sites,site_code',
            'site_name'       => 'required|string',
            'region_id'       => 'required|exists:regions,id',
            'province_id'     => 'required|exists:provinces,id',
            'district_id'     => 'required|exists:districts,id',
            'locality_id'     => 'required|exists:localities,id',
            'contract_status' => 'required|in:active,terminated,for renewal',
            'contract_id'     => 'required|exists:contracts,id',
            'category_id'     => 'required|exists:categories,id',
            'contractor_id'   => 'required|exists:contractors,id',
            'latitude'        => 'required|string',
            'longitude'       => 'required|string',
        ]);
    
        Fw4a::create($validated);
    
        return redirect()->back()->with('success', 'New site has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fw4a $fw4a)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fw4a $fw4a)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fw4a $fw4a)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fw4a $fw4a)
    {
        //
    }
}
