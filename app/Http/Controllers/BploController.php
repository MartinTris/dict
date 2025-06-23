<?php

namespace App\Http\Controllers;

use App\Models\Bplo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BploController extends Controller
{
    /**
     * Display a listing of the BPLO records.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bplos = Bplo::all();
        return view('innovate.bplo.bplo', compact('bplos'));
    }

    /**
     * Show the form for creating a new BPLO record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('innovate.bplo.create');
    }

    /**
     * Store a newly created BPLO record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'province' => 'required|string|max:255',
            'municipality_city' => 'required|string|max:255',
            'bpco_status' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'congressional_district' => 'required|string|max:255',
            'income_class' => 'required|string|max:255',
        ]);

        Bplo::create($validated);

        return redirect()->route('bplo')
            ->with('success', 'BPLO record created successfully.');
    }

    /**
     * Display the specified BPLO record.
     *
     * @param  \App\Models\Bplo  $bplo
     * @return \Illuminate\Http\Response
     */
    public function show(Bplo $bplo)
    {
        return view('innovate.bplo.show', compact('bplo'));
    }

    /**
     * Show the form for editing the specified BPLO record.
     *
     * @param  \App\Models\Bplo  $bplo
     * @return \Illuminate\Http\Response
     */
    public function edit(Bplo $bplo)
    {
        return view('innovate.bplo.edit', compact('bplo'));
    }

    /**
     * Update the specified BPLO record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bplo  $bplo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bplo $bplo)
    {
        $validated = $request->validate([
            'province' => 'required|string|max:255',
            'municipality_city' => 'required|string|max:255',
            'bpco_status' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'congressional_district' => 'required|string|max:255',
            'income_class' => 'required|string|max:255',
        ]);

        $bplo->update($validated);

        return redirect()->route('bplo')
            ->with('success', 'BPLO record updated successfully.');
    }

    /**
     * Remove the specified BPLO record from storage.
     *
     * @param  \App\Models\Bplo  $bplo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bplo $bplo)
    {
        $bplo->delete();
        
        // Check if this was the last record, and if so, reset the IDs
        if (Bplo::count() == 0) {
            $this->reindexAllIds();
        }

        return redirect()->route('bplo')
            ->with('success', 'BPLO record deleted successfully.');
    }
    
    /**
     * Reset auto-increment and reindex all records
     */
    private function reindexAllIds()
    {
        // Get all existing records in order
        $records = Bplo::orderBy('id')->get()->toArray();
        
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate the table
        DB::table('bplos')->truncate();
        
        // Reset auto-increment
        DB::statement('ALTER TABLE bplos AUTO_INCREMENT = 1;');
        
        // Re-insert all records with new sequential IDs
        foreach ($records as $record) {
            // Remove the ID before inserting
            unset($record['id']);
            DB::table('bplos')->insert($record);
        }
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    
    /**
     * Display data visualization for BPLO records.
     *
     * @return \Illuminate\Http\Response
     */
    public function visualization()
    {
        // Count by BPCO status
        $statusCounts = Bplo::select('bpco_status', DB::raw('count(*) as count'))
                            ->groupBy('bpco_status')
                            ->get();
        
        // Count by Congressional District
        $districtCounts = Bplo::select('congressional_district', DB::raw('count(*) as count'))
                            ->groupBy('congressional_district')
                            ->get();
        
        // Count by Income Class
        $incomeCounts = Bplo::select('income_class', DB::raw('count(*) as count'))
                            ->groupBy('income_class')
                            ->get();
                            
        $total = Bplo::count();
        
        return view('innovate.bplo.visualization', compact(
            'statusCounts', 
            'districtCounts', 
            'incomeCounts', 
            'total'
        ));
    }
}