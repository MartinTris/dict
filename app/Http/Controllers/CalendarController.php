<?php

namespace App\Http\Controllers;
use App\Models\CalendarEvent;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('calendar.index', compact('projects'));
    }

    public function fetch()
    {
        $events = CalendarEvent::with('project')->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => Carbon::parse($event->start)->toIso8601String(),
                'end' => Carbon::parse($event->end)->toIso8601String(),
                'description' => $event->description,
                'location' => $event->location,
                'assigned' => $event->assigned,
                'project' => $event->project ? $event->project->name : null,
                'project_id' => $event->project_id
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
            'assigned' => 'nullable|string|max:255',
            'project' => 'nullable|exists:projects,id',
        ]);

        // Convert project to project_id for database
        if (isset($validated['project'])) {
            $validated['project_id'] = $validated['project'];
            unset($validated['project']);
        }

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
            'assigned' => 'nullable|string|max:255',
            'project' => 'nullable|exists:projects,id',
        ]);

        // Convert project to project_id for database
        if (isset($validated['project'])) {
            $validated['project_id'] = $validated['project'];
            unset($validated['project']);
        }

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
    public function storeProject(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $project = Project::create(['name' => $request->name]);
        return response()->json($project);
    }

    public function destroyProject($id)
    {
        $project = Project::findOrFail($id);
        if ($project->events()->exists()) {
            return response()->json(['message' => 'Cannot delete project with assigned events.'], 400);
        }
        $project->delete();
        return response()->json(['message' => 'Project deleted.']);
    }

}
