<?php

namespace App\Http\Controllers;

use App\Models\EgovOrientation;
use Illuminate\Http\Request;
use App\Exports\EgovOrientationExport;
use Maatwebsite\Excel\Facades\Excel;

class eGovOrientationController extends Controller
{
    /**
     * Normalize municipality name by removing "City" suffix
     */
    private function normalizeMunicipalityName($municipality)
    {
        $municipality = str_replace(' City', '', $municipality);
        $municipality = str_replace(' CITY', '', $municipality);
        $municipality = str_replace(' city', '', $municipality);
        $municipality = str_replace('City of ', '', $municipality);
        $municipality = str_replace('CITY OF ', '', $municipality);
        $municipality = str_replace('city of ', '', $municipality);
        return trim($municipality);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EgovOrientation::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('training_control_no', 'like', "%{$search}%")
                  ->orWhere('event_name', 'like', "%{$search}%")
                  ->orWhere('venue', 'like', "%{$search}%")
                  ->orWhere('participants', 'like', "%{$search}%")
                  ->orWhere('province', 'like', "%{$search}%")
                  ->orWhere('municipality', 'like', "%{$search}%");
            });
        }

        // Filter by province
        if ($request->filled('province')) {
            $query->where('province', $request->province);
        }

        // Filter by municipality with normalization
        if ($request->filled('municipality')) {
            $normalizedMunicipality = $this->normalizeMunicipalityName($request->municipality);
            $query->where(function ($q) use ($normalizedMunicipality) {
                $q->where('municipality', 'like', "%{$normalizedMunicipality}%")
                  ->orWhere('municipality', 'like', "%{$normalizedMunicipality} City%")
                  ->orWhere('municipality', 'like', "%{$normalizedMunicipality} CITY%")
                  ->orWhere('municipality', 'like', "City of {$normalizedMunicipality}%")
                  ->orWhere('municipality', 'like', "CITY OF {$normalizedMunicipality}%");
            });
        }

        $egovOrientations = $query->orderBy('date', 'desc')->paginate(10);

        // Get unique provinces and municipalities for filters
        $provinces = EgovOrientation::select('province')
            ->whereNotNull('province')
            ->where('province', '!=', '')
            ->groupBy('province')
            ->orderBy('province')
            ->pluck('province');

        // Normalize municipality names to eliminate duplicates
        $municipalities = EgovOrientation::select('municipality')
            ->whereNotNull('municipality')
            ->where('municipality', '!=', '')
            ->groupBy('municipality')
            ->orderBy('municipality')
            ->get()
            ->map(function ($item) {
                return $this->normalizeMunicipalityName($item->municipality);
            })
            ->unique()
            ->sort()
            ->values();

        return view('innovate.egov.egov-orientation', compact('egovOrientations', 'provinces', 'municipalities'));
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
        $request->validate([
            'date' => 'required|date',
            'training_control_no' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'participants' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'mode' => 'required|in:Online,Face to Face',
            'status' => 'required|string|max:255',
            'no_of_attendees' => 'required|string|max:255',
            'no_of_downloaded_and_verified' => 'required|string|max:255',
            'male' => 'required|string|max:255',
            'female' => 'required|string|max:255',
            'link' => 'nullable|string|max:500',
        ]);

        EgovOrientation::create($request->all());

        return redirect()->route('egov-orientation.index')->with('success', 'eGov Orientation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EgovOrientation $egovOrientation)
    {
        return view('innovate.egov.orientations.show', compact('egovOrientation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EgovOrientation $egovOrientation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EgovOrientation $egovOrientation)
    {
        $request->validate([
            'date' => 'required|date',
            'training_control_no' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'participants' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'mode' => 'required|in:Online,Face to Face',
            'status' => 'required|string|max:255',
            'no_of_attendees' => 'required|string|max:255',
            'no_of_downloaded_and_verified' => 'required|string|max:255',
            'male' => 'required|string|max:255',
            'female' => 'required|string|max:255',
            'link' => 'nullable|string|max:500',
        ]);

        $egovOrientation->update($request->all());

        return redirect()->route('egov-orientation.index')->with('success', 'eGov Orientation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EgovOrientation $egovOrientation)
    {
        $egovOrientation->delete();

        return redirect()->route('egov-orientation.index')->with('success', 'eGov Orientation deleted successfully!');
    }

    public function export($format)
    {
        $fileName = 'egov_orientations_' . now()->format('Ymd_His') . '.' . $format;

        if (!in_array($format, ['xlsx', 'csv', 'pdf'])) {
            abort(400, 'Invalid export format.');
        }

        return Excel::download(new EgovOrientationExport, $fileName, match($format) {
            'csv' => \Maatwebsite\Excel\Excel::CSV,
            'pdf' => \Maatwebsite\Excel\Excel::DOMPDF,
            default => \Maatwebsite\Excel\Excel::XLSX,
        });
    }
}
