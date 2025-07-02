<?php

namespace App\Http\Controllers;

use App\Models\Ilcdb;
use Illuminate\Http\Request;

class IlcdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('harness.ilcdb.ilcdb');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ilcdb $ilcdb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ilcdb $ilcdb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ilcdb $ilcdb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ilcdb $ilcdb)
    {
        //
    }
}
