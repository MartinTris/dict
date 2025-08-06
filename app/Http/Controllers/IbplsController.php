<?php

namespace App\Http\Controllers;

use App\Models\Ibpls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IbplsController extends Controller
{
    /**
     * Normalize location name by removing "City" suffix
     */
    private function normalizeLocationName($location)
    {
        $location = str_replace(' City', '', $location);
        $location = str_replace(' CITY', '', $location);
        $location = str_replace(' city', '', $location);
        $location = str_replace('City of ', '', $location);
        $location = str_replace('CITY OF ', '', $location);
        $location = str_replace('city of ', '', $location);
        return trim($location);
    }

    /**
     * Display a listing of the IBPLS records.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ibplsRecords = Ibpls::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('location', 'like', "%$search%")
                      ->orWhere('district', 'like', "%$search%")
                      ->orWhere('operation', 'like', "%$search%")
                      ->orWhere('status', 'like', "%$search%");
                });
            })
            ->when($request->filled('location'), function ($query) use ($request) {
                $normalizedLocation = $this->normalizeLocationName($request->location);
                $query->where(function ($q) use ($normalizedLocation) {
                    $q->where('location', 'like', "%{$normalizedLocation}%")
                      ->orWhere('location', 'like', "%{$normalizedLocation} City%")
                      ->orWhere('location', 'like', "%{$normalizedLocation} CITY%")
                      ->orWhere('location', 'like', "City of {$normalizedLocation}%")
                      ->orWhere('location', 'like', "CITY OF {$normalizedLocation}%");
                });
            })
            ->when($request->filled('district'), function ($query) use ($request) {
                $query->where('district', $request->district);
            })
            ->paginate(10)
            ->withQueryString();

        // Get unique values for filters
        // Normalize location names to eliminate duplicates
        $locations = Ibpls::select('location')
            ->groupBy('location')
            ->orderBy('location')
            ->get()
            ->map(function ($item) {
                return $this->normalizeLocationName($item->location);
            })
            ->unique()
            ->sort()
            ->values();

        $districts = Ibpls::select('district')
            ->groupBy('district')
            ->orderBy('district')
            ->pluck('district');

        return view('innovate.ibpls.ibpls', compact(
            'ibplsRecords',
            'locations',
            'districts',
        ));
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
            'district' => 'required|string|max:255',
            'operation' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();
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
            'district' => 'required|string|max:255',
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