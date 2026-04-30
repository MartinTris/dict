<?php

namespace App\Http\Controllers;

use App\Http\Requests\Leave\StoreLeaveRequest;
use App\Models\Leave;
use App\Models\LeaveType;
use Carbon\Carbon;

class EmployeeLeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('type')
            ->where('employee_id', auth('employee')->id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('employee.leaves.index', compact('leaves'));
    }

    public function create()
    {
        $leaveTypes = LeaveType::where('is_active', true)->orderBy('name')->get();

        return view('employee.leaves.create', compact('leaveTypes'));
    }

    public function store(StoreLeaveRequest $request)
    {
        $days = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) + 1;

        Leave::create([
            'employee_id' => auth('employee')->id(),
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'number_of_days' => $days,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('employee.leaves.index')->with('success', 'Leave request submitted.');
    }
}