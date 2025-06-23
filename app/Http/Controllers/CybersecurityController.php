<?php

namespace App\Http\Controllers;

use App\Models\Cybersecurity;
use Illuminate\Http\Request;

class CybersecurityController extends Controller
{
    public function index()
    {
        $cybersecurityRecords = Cybersecurity::all();
        return view('protect.cybersecurity.cybersecurity', compact('cybersecurityRecords'));
    }

    public function create()
    {
        return view('protect.cybersecurity.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_conducted' => 'required|date',
            'time_conducted' => 'required|string',
            'organizer' => 'required|string|max:255',
            'province' => 'required|string|max:255',
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

        Cybersecurity::create($validated);

        return redirect()->route('cybersecurity')->with('success', 'Cybersecurity record created successfully!');
    }

    public function show(Cybersecurity $cybersecurity)
    {
        return view('protect.cybersecurity.show', compact('cybersecurity'));
    }

    public function edit(Cybersecurity $cybersecurity)
    {
        return view('protect.cybersecurity.edit', compact('cybersecurity'));
    }

    public function update(Request $request, Cybersecurity $cybersecurity)
    {
        $validated = $request->validate([
            'date_conducted' => 'required|date',
            'time_conducted' => 'required|string',
            'organizer' => 'required|string|max:255',
            'province' => 'required|string|max:255',
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