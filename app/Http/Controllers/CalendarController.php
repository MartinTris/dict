<?php

namespace App\Http\Controllers;
use App\Models\CalendarEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function fetch()
    {
        $events = CalendarEvent::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => Carbon::parse($event->start)->toIso8601String(),
                'end' => Carbon::parse($event->end)->toIso8601String(),
                'description' => $event->description,
                'location' => $event->location
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        $event = CalendarEvent::create($validated);

        return response()->json(['event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        $event = CalendarEvent::findOrFail($id);
        $event->update($validated);

        return response()->json(['event' => $event]);
    }

    public function destroy($id)
    {
        $event = CalendarEvent::findOrFail($id);
        $event->delete();

        return response()->json(['success' => true]);
    }
}
