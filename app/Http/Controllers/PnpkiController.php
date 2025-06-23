<?php

namespace App\Http\Controllers;

use App\Models\Pnpki;
use Illuminate\Http\Request;

class PnpkiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pnpkis = Pnpki::all();
        return view('protect.pnpki.pnpki', compact('pnpkis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('protect.pnpki.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $validatedData = $request->validate([
            'date_conducted' => 'required|date',
            'time_conducted' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'activity_title' => 'required|string|max:255',
            'type_of_activity' => 'required|in:PNPKI Orientation,PNPKI Personnel Training,PNPKI User\'s Training',
            'mode_of_implementation' => 'required|string|max:255',
            'zoom_link' => 'nullable|string|max:255',
            'male_participants' => 'required|integer|min:0',
            'female_participants' => 'required|integer|min:0',
            'participant_details' => 'required|string',
            'resource_person' => 'required|string|max:255',
            'fb_posting' => 'nullable|string|max:255',
            'number_of_engagement' => 'nullable|integer|min:0',
            'list_of_engaged_partners' => 'required|string',
        ]);

        // Calculate total participants
        $validatedData['total_participants'] = $validatedData['male_participants'] + $validatedData['female_participants'];

        Pnpki::create($validatedData);
        
        return redirect()->route('pnpki')->with('success', 'PNPKI record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pnpki $pnpki)
    {
        return view('protect.pnpki.show', compact('pnpki'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pnpki $pnpki)
    {
        return view('protect.pnpki.edit', compact('pnpki'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pnpki $pnpki)
    {
         $validatedData = $request->validate([
            'date_conducted' => 'required|date',
            'time_conducted' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'activity_title' => 'required|string|max:255',
            'type_of_activity' => 'required|in:PNPKI Orientation,PNPKI Personnel Training,PNPKI User\'s Training',
            'mode_of_implementation' => 'required|string|max:255',
            'zoom_link' => 'nullable|string|max:255',
            'male_participants' => 'required|integer|min:0',
            'female_participants' => 'required|integer|min:0',
            'participant_details' => 'required|string',
            'resource_person' => 'required|string|max:255',
            'fb_posting' => 'nullable|string|max:255',
            'number_of_engagement' => 'nullable|integer|min:0',
            'list_of_engaged_partners' => 'required|string',
        ]);

        // Calculate total participants
        $validatedData['total_participants'] = $validatedData['male_participants'] + $validatedData['female_participants'];

        $pnpki->update($validatedData);
        
        return redirect()->route('pnpki')->with('success', 'PNPKI record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pnpki $pnpki)
    {
        $pnpki->delete();
        
        return redirect()->route('pnpki')->with('success', 'PNPKI record deleted successfully.');
    }

    /**
     * Display data visualization.
     */
    public function visualization()
    {
        $pnpkis = Pnpki::all();
        $typeActivities = Pnpki::select('type_of_activity', \DB::raw('count(*) as count'))
            ->groupBy('type_of_activity')
            ->get();
        
        $totalMale = Pnpki::sum('male_participants');
        $totalFemale = Pnpki::sum('female_participants');
        
        return view('protect.pnpki.visualization', compact('pnpkis', 'typeActivities', 'totalMale', 'totalFemale'));
    }
}