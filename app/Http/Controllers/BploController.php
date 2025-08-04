<?php

namespace App\Http\Controllers;

use App\Models\Bplo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BploController extends Controller
{
    /**
     * Normalize municipality name by removing "City" suffix
     */
    private function normalizeMunicipalityName($municipality)
    {
        $municipality = str_replace(' City', '', $municipality);
        $municipality = str_replace(' CITY', '', $municipality);
        $municipality = str_replace(' city', '', $municipality);
        return trim($municipality);
    }

    /**
     * Display a listing of the BPLO records.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bplos = Bplo::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('province', 'like', "%$search%")
                      ->orWhere('municipality_city', 'like', "%$search%")
                      ->orWhere('bpco_status', 'like', "%$search%")
                      ->orWhere('congressional_district', 'like', "%$search%")
                      ->orWhere('income_class', 'like', "%$search%")
                      ->orWhere('remarks', 'like', "%$search%");
                });
            })
            ->when($request->filled('province'), function ($query) use ($request) {
                $query->where('province', $request->province);
            })
            ->when($request->filled('municipality_city'), function ($query) use ($request) {
                $normalizedMunicipality = $this->normalizeMunicipalityName($request->municipality_city);
                $query->where(function ($q) use ($normalizedMunicipality) {
                    $q->where('municipality_city', 'like', "%{$normalizedMunicipality}%")
                      ->orWhere('municipality_city', 'like', "%{$normalizedMunicipality} City%")
                      ->orWhere('municipality_city', 'like', "%{$normalizedMunicipality} CITY%");
                });
            })
            ->when($request->filled('congressional_district'), function ($query) use ($request) {
                $query->where('congressional_district', $request->congressional_district);
            })
            ->paginate(10)
            ->withQueryString();

        // Get unique values for filters
        $provinces = Bplo::select('province')
            ->groupBy('province')
            ->orderBy('province')
            ->pluck('province');

        // Normalize municipality names to eliminate duplicates
        $municipalities = Bplo::select('municipality_city')
            ->groupBy('municipality_city')
            ->orderBy('municipality_city')
            ->get()
            ->map(function ($item) {
                return $this->normalizeMunicipalityName($item->municipality_city);
            })
            ->unique()
            ->sort()
            ->values();

        $congressionalDistricts = Bplo::select('congressional_district')
            ->groupBy('congressional_district')
            ->orderBy('congressional_district')
            ->pluck('congressional_district');

        return view('innovate.bplo.bplo', compact(
            'bplos',
            'provinces',
            'municipalities',
            'congressionalDistricts'
        ));
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