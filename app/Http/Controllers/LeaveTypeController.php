<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveType\StoreLeaveTypeRequest;
use App\Http\Requests\LeaveType\UpdateLeaveTypeRequest;
use App\Models\LeaveType;
use Illuminate\Support\Str;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::orderBy('name')->get();

        return view('management.leave-types.index', compact('leaveTypes'));
    }

    public function create()
    {
        return view('management.leave-types.create');
    }

    public function store(StoreLeaveTypeRequest $request)
    {
        LeaveType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => (bool) $request->is_active,
        ]);

        return redirect()->route('leave-types.index')->with('success', 'Leave type created.');
    }

    public function edit(LeaveType $leave_type)
    {
        return view('management.leave-types.edit', compact('leave_type'));
    }

    public function update(UpdateLeaveTypeRequest $request, LeaveType $leave_type)
    {
        $leave_type->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => (bool) $request->is_active,
        ]);

        return redirect()->route('leave-types.index')->with('success', 'Leave type updated.');
    }

    public function destroy(LeaveType $leave_type)
    {
        $leave_type->delete();

        return redirect()->route('leave-types.index')->with('success', 'Leave type deleted.');
    }
}
