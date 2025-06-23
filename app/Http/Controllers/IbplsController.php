<?php

namespace App\Http\Controllers;

use App\Models\Ibpls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IbplsController extends Controller
{
    /**
     * Display a listing of the IBPLS records.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ibplsRecords = Ibpls::all();
        return view('innovate.ibpls.ibpls', compact('ibplsRecords'));
    }

    /**
     * Show the form for creating a new IBPLS record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('innovate.ibpls.create');
    }

    /**
     * Store a newly created IBPLS record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'operation' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        Ibpls::create($validated);

        return redirect()->route('ibpls')
            ->with('success', 'IBPLS record created successfully.');
    }

    /**
     * Display the specified IBPLS record.
     *
     * @param  \App\Models\Ibpls  $ibpls
     * @return \Illuminate\Http\Response
     */
    public function show(Ibpls $ibpls)
    {
        return view('innovate.ibpls.show', compact('ibpls'));
    }

    /**
     * Show the form for editing the specified IBPLS record.
     *
     * @param  \App\Models\Ibpls  $ibpls
     * @return \Illuminate\Http\Response
     */
    public function edit(Ibpls $ibpls)
    {
        return view('innovate.ibpls.edit', compact('ibpls'));
    }

    /**
     * Update the specified IBPLS record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ibpls  $ibpls
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ibpls $ibpls)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'operation' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $ibpls->update($validated);

        return redirect()->route('ibpls')
            ->with('success', 'IBPLS record updated successfully.');
    }

    /**
     * Remove the specified IBPLS record from storage.
     *
     * @param  \App\Models\Ibpls  $ibpls
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ibpls $ibpls)
    {
        $ibpls->delete();
        
        // Check if this was the last record, and if so, reset the IDs
        if (Ibpls::count() == 0) {
            $this->reindexAllIds();
        }

        return redirect()->route('ibpls')
            ->with('success', 'IBPLS record deleted successfully.');
    }
    
    private function reindexAllIds()
    {
        // Get all existing records in order
        $records = Ibpls::orderBy('id')->get()->toArray();
        
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate the table
        DB::table('ibpls')->truncate();
        
        // Reset auto-increment
        DB::statement('ALTER TABLE ibpls AUTO_INCREMENT = 1;');
        
        // Re-insert all records with new sequential IDs
        foreach ($records as $record) {
            // Remove the ID before inserting
            unset($record['id']);
            DB::table('ibpls')->insert($record);
        }
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    
    /**
     * Display data visualization for IBPLS records.
     *
     * @return \Illuminate\Http\Response
     */
    public function visualization()
    {
        $operationStats = Ibpls::select('operation', \DB::raw('count(*) as count'))
            ->groupBy('operation')
            ->get();
            
        $statusStats = Ibpls::select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();
            
        return view('innovate.ibpls.visualization', compact('operationStats', 'statusStats'));
    }
}