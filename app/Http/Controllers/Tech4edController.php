<?php

namespace App\Http\Controllers;

use App\Models\Tech4ed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Tech4edController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tech4eds = Tech4ed::all();
        return view('harness.tech4ed.tech4ed', compact('tech4eds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('harness.tech4ed.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'congressional_district' => 'required',
            'municipality' => 'required',
            'specific_center_location' => 'required',
            'center_name' => 'required',
            'center_model' => 'required',
            'cm_name' => 'required',
            'cm_email' => 'required',
            'cm_mobile' => 'required',
            'cm_sex' => 'required',
            'date_of_launching' => 'required',
            'operational' => 'required',
            'with_donation' => 'required',
            'type_of_donation' => 'nullable',
        ]);

        Tech4ed::create($request->all());
        return redirect()->route('tech4ed')
            ->with('success', 'TECH4ED center added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tech4ed  $tech4ed
     * @return \Illuminate\Http\Response
     */
    public function show(Tech4ed $tech4ed)
    {
        return view('harness.tech4ed.show', compact('tech4ed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tech4ed  $tech4ed
     * @return \Illuminate\Http\Response
     */
    public function edit(Tech4ed $tech4ed)
    {
        return view('harness.tech4ed.edit', compact('tech4ed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tech4ed  $tech4ed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tech4ed $tech4ed)
    {
        $request->validate([
            'congressional_district' => 'required',
            'municipality' => 'required',
            'specific_center_location' => 'required',
            'center_name' => 'required',
            'center_model' => 'required',
            'cm_name' => 'required',
            'cm_email' => 'required',
            'cm_mobile' => 'required',
            'cm_sex' => 'required',
            'date_of_launching' => 'required',
            'operational' => 'required',
            'with_donation' => 'required',
            'type_of_donation' => 'nullable',
        ]);

        $tech4ed->update($request->all());
        return redirect()->route('tech4ed')
            ->with('success', 'TECH4ED center updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tech4ed  $tech4ed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tech4ed $tech4ed)
    {
        $tech4ed->delete();
        
        // Check if this was the last record, and if so, reset the IDs
        if (Tech4ed::count() == 0) {
            $this->reindexAllIds();
        }
        
        return redirect()->route('tech4ed')
            ->with('success', 'TECH4ED center deleted successfully.');
    }
    
    /**
     * Reset the IDs in the database.
     *
     * @return void
     */
    private function reindexAllIds()
    {
        // Get all existing records in order
        $records = Tech4ed::orderBy('id')->get()->toArray();
        
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate the table
        DB::table('tech4eds')->truncate();
        
        // Reset auto-increment
        DB::statement('ALTER TABLE tech4eds AUTO_INCREMENT = 1;');
        
        // Re-insert all records with new sequential IDs
        foreach ($records as $record) {
            // Remove the ID before inserting
            unset($record['id']);
            DB::table('tech4eds')->insert($record);
        }
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Display the visualization for TECH4ED data.
     *
     * @return \Illuminate\Http\Response
     */
    public function visualization()
    {
        $tech4eds = Tech4ed::all();
        
        // Get unique center models
        $centerModels = Tech4ed::select('center_model')
                        ->groupBy('center_model')
                        ->get()
                        ->pluck('center_model');
        
        // Get unique operational statuses
        $operationalStatus = Tech4ed::select('operational')
                            ->groupBy('operational')
                            ->get()
                            ->pluck('operational');
        
        // Get unique donation statuses
        $donationStatus = Tech4ed::select('with_donation')
                          ->groupBy('with_donation')
                          ->get()
                          ->pluck('with_donation');
        
        return view('harness.tech4ed.visualization', compact('tech4eds', 'centerModels', 'operationalStatus', 'donationStatus'));
    }
}