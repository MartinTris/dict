<?php

namespace App\Http\Controllers;

use App\Models\Tech4ed;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Tech4edController extends Controller
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
     * Convert congressional district format from "1ST", "2ND" to "I", "II" format
     */
    private function convertCongressionalDistrict($congressionalDistrict)
    {
        $mapping = [
            '1ST' => 'I',
            '2ND' => 'II', 
            '3RD' => 'III',
            '4TH' => 'IV',
            '5TH' => 'V',
            '6TH' => 'VI',
            '7TH' => 'VII',
            '8TH' => 'VIII'
        ];
        
        return $mapping[strtoupper($congressionalDistrict)] ?? $congressionalDistrict;
    }

    /**
     * Convert district format from "I", "II" to "1ST", "2ND" format
     */
    private function convertDistrictToCongressional($districtName)
    {
        $mapping = [
            'I' => '1ST',
            'II' => '2ND',
            'III' => '3RD',
            'IV' => '4TH',
            'V' => '5TH',
            'VI' => '6TH',
            'VII' => '7TH',
            'VIII' => '8TH',
        ];
        
        return $mapping[strtoupper($districtName)] ?? $districtName;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tech4eds = Tech4ed::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('congressional_district', 'like', "%$search%")
                      ->orWhere('municipality', 'like', "%$search%")
                      ->orWhere('specific_center_location', 'like', "%$search%")
                      ->orWhere('center_name', 'like', "%$search%")
                      ->orWhere('center_model', 'like', "%$search%")
                      ->orWhere('cm_name', 'like', "%$search%")
                      ->orWhere('cm_email', 'like', "%$search%")
                      ->orWhere('operational', 'like', "%$search%")
                      ->orWhere('with_donation', 'like', "%$search%");
                });
            })
            ->when($request->filled('congressional_district'), function ($query) use ($request) {
                $query->where('congressional_district', $request->congressional_district);
            })
            ->when($request->filled('municipality'), function ($query) use ($request) {
                $normalizedMunicipality = $this->normalizeMunicipalityName($request->municipality);
                $query->where(function ($q) use ($normalizedMunicipality) {
                    $q->where('municipality', 'like', "%{$normalizedMunicipality}%")
                      ->orWhere('municipality', 'like', "%{$normalizedMunicipality} City%")
                      ->orWhere('municipality', 'like', "%{$normalizedMunicipality} CITY%");
                });
            })
            ->paginate(10)
            ->withQueryString();

        // Get unique values for filters
        $congressionalDistricts = Tech4ed::select('congressional_district')
            ->groupBy('congressional_district')
            ->orderBy('congressional_district')
            ->pluck('congressional_district');

        // Normalize municipality names to eliminate duplicates
        $municipalities = Tech4ed::select('municipality')
            ->groupBy('municipality')
            ->orderBy('municipality')
            ->get()
            ->map(function ($item) {
                return $this->normalizeMunicipalityName($item->municipality);
            })
            ->unique()
            ->sort()
            ->values();

        // Get original municipality names for display (keeping duplicates for accurate display)
        $originalMunicipalities = Tech4ed::select('municipality')
            ->groupBy('municipality')
            ->orderBy('municipality')
            ->pluck('municipality');

        $centerModels = Tech4ed::select('center_model')
            ->groupBy('center_model')
            ->orderBy('center_model')
            ->pluck('center_model');

        $operationalStatus = Tech4ed::select('operational')
            ->groupBy('operational')
            ->orderBy('operational')
            ->pluck('operational');

        $donationStatus = Tech4ed::select('with_donation')
            ->groupBy('with_donation')
            ->orderBy('with_donation')
            ->pluck('with_donation');

        return view('harness.tech4ed.tech4ed', compact(
            'tech4eds', 
            'congressionalDistricts', 
            'municipalities', 
            'originalMunicipalities',
            'centerModels', 
            'operationalStatus', 
            'donationStatus'
        ));
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

        $data = $request->all();
        $data['user_id'] = auth()->id();
        Tech4ed::create($data);
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

    /**
     * Filter Tech4ED records by district ID using mapping
     */
    public function filterByDistrict($districtId)
    {
        $district = District::find($districtId);
        if (!$district) {
            return response()->json([]);
        }

        $congressionalDistrict = $this->convertDistrictToCongressional($district->district_name);
        
        $tech4eds = Tech4ed::where('congressional_district', $congressionalDistrict)
            ->get();

        return response()->json($tech4eds);
    }

    /**
     * Get districts for potential integration
     */
    public function getDistricts()
    {
        $districts = District::orderBy('district_name')->get();
        return response()->json($districts);
    }

    /**
     * Get congressional districts mapped to district IDs
     */
    public function getCongressionalDistricts()
    {
        $districts = District::orderBy('district_name')->get();
        $congressionalDistricts = [];
        
        foreach ($districts as $district) {
            $congressionalDistricts[] = [
                'id' => $district->id,
                'district_name' => $district->district_name,
                'congressional_district' => $this->convertDistrictToCongressional($district->district_name)
            ];
        }
        
        return response()->json($congressionalDistricts);
    }
}