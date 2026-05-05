<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $types = LeaveType::orderBy('name')->paginate(10);
        return view('admin.leave-types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.leave-types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:leave_types,name'],
            'description' => ['nullable','string'],
            'default_allocation' => ['required','integer','min:0'],
            'color' => ['nullable','string','max:20'],
        ]);

        LeaveType::create($data);
        return redirect()->route('admin.leave-types.index')->with('success', 'Leave type created.');
    }

    public function edit(LeaveType $leaveType)
    {
        return view('admin.leave-types.edit', compact('leaveType'));
    }

    public function update(Request $request, LeaveType $leaveType)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:leave_types,name,'.$leaveType->id],
            'description' => ['nullable','string'],
            'default_allocation' => ['required','integer','min:0'],
            'color' => ['nullable','string','max:20'],
        ]);

        $leaveType->update($data);
        return redirect()->route('admin.leave-types.index')->with('success', 'Leave type updated.');
    }

    public function destroy(LeaveType $leaveType)
    {
        if ($leaveType->leaves()->exists()) {
            return back()->withErrors('Cannot delete. Leave type already used.');
        }

        $leaveType->delete();
        return back()->with('success', 'Leave type deleted.');
    }
}