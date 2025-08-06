<?php

namespace App\Http\Controllers;

use App\Models\Cybersecurity;
use App\Models\Region;
use Illuminate\Http\Request;

class CybersecurityController extends Controller
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

    public function index(Request $request)
    {
        $cybersecurityRecords = Cybersecurity::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('date_conducted', 'like', "%$search%")
                      ->orWhere('time_conducted', 'like', "%$search%")
                      ->orWhere('organizer', 'like', "%$search%")
                      ->orWhere('province', 'like', "%$search%")
                      ->orWhere('municipality', 'like', "%$search%")
                      ->orWhere('district', 'like', "%$search%")
                      ->orWhere('activity_title', 'like', "%$search%")
                      ->orWhere('type_of_activity', 'like', "%$search%")
                      ->orWhere('mode_of_implementation', 'like', "%$search%")
                      ->orWhere('resource_person', 'like', "%$search%");
                });
            })
            ->when($request->filled('province'), function ($query) use ($request) {
                $query->where('province', $request->province);
            })
            ->when($request->filled('municipality'), function ($query) use ($request) {
                $normalizedMunicipality = $this->normalizeMunicipalityName($request->municipality);
                $query->where(function ($q) use ($normalizedMunicipality) {
                    $q->where('municipality', 'like', "%{$normalizedMunicipality}%")
                      ->orWhere('municipality', 'like', "%{$normalizedMunicipality} City%")
                      ->orWhere('municipality', 'like', "%{$normalizedMunicipality} CITY%")
                      ->orWhere('municipality', 'like', "City of {$normalizedMunicipality}%")
                      ->orWhere('municipality', 'like', "CITY OF {$normalizedMunicipality}%");
                });
            })
            ->when($request->filled('district'), function ($query) use ($request) {
                $query->where('district', $request->district);
            })
            ->paginate(10)
            ->withQueryString();

        // Get unique values for filters
        $provinces = Cybersecurity::select('province')
            ->whereNotNull('province')
            ->where('province', '!=', '')
            ->groupBy('province')
            ->orderBy('province')
            ->pluck('province');

        // Normalize municipality names to eliminate duplicates
        $municipalities = Cybersecurity::select('municipality')
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

        $districts = Cybersecurity::select('district')
            ->whereNotNull('district')
            ->where('district', '!=', '')
            ->groupBy('district')
            ->orderBy('district')
            ->pluck('district');

        return view('protect.cybersecurity.cybersecurity', compact(
            'cybersecurityRecords',
            'provinces',
            'municipalities',
            'districts',
        ));
    }

    public function create()
    {
        $regions = Region::all();
        return view('protect.cybersecurity.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_conducted' => 'required|date',
            'time_conducted' => 'required|string',
            'organizer' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'activity_title' => 'required|string|max:255',
            'type_of_activity' => 'required|in:Cyber Advocacies,CERT Trainings',
            'mode_of_implementation' => 'required|string|max:255',
            'zoom_link' => 'nullable|string|max:255',
            'male_participants' => 'required|integer|min:0',
            'female_participants' => 'required|integer|min:0',
            'participant_details' => 'nullable|string',
            'resource_person' => 'required|string|max:255',
            'fb_posting' => 'nullable|string|max:255',
            'number_of_engagement' => 'nullable|integer|min:0',
            'list_of_engaged_partners' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        Cybersecurity::create($validated);

        return redirect()->route('cybersecurity')->with('success', 'Cybersecurity record created successfully!');
    }

    public function show(Cybersecurity $cybersecurity)
    {
        $regions = Region::all();
        return view('protect.cybersecurity.show', compact('cybersecurity', 'regions'));
    }

    public function edit(Cybersecurity $cybersecurity)
    {
        $regions = Region::all();
        return view('protect.cybersecurity.edit', compact('cybersecurity', 'regions'));
    }

    public function update(Request $request, Cybersecurity $cybersecurity)
    {
        $validated = $request->validate([
            'date_conducted' => 'required|date',
            'time_conducted' => 'required|string',
            'organizer' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'activity_title' => 'required|string|max:255',
            'type_of_activity' => 'required|in:Cyber Advocacies,CERT Trainings',
            'mode_of_implementation' => 'required|string|max:255',
            'zoom_link' => 'nullable|string|max:255',
            'male_participants' => 'required|integer|min:0',
            'female_participants' => 'required|integer|min:0',
            'participant_details' => 'nullable|string',
            'resource_person' => 'required|string|max:255',
            'fb_posting' => 'nullable|string|max:255',
            'number_of_engagement' => 'nullable|integer|min:0',
            'list_of_engaged_partners' => 'nullable|string',
        ]);

        $cybersecurity->update($validated);

        return redirect()->route('cybersecurity')->with('success', 'Cybersecurity record updated successfully!');
    }

    public function destroy(Cybersecurity $cybersecurity)
    {
        $cybersecurity->delete();
        return redirect()->route('cybersecurity')->with('success', 'Cybersecurity record deleted successfully!');
    }

    public function visualization()
    {
        $cybersecurityRecords = Cybersecurity::all();
        return view('protect.cybersecurity.visualization', compact('cybersecurityRecords'));
    }
}