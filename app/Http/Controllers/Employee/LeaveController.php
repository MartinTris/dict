<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use App\Services\LeaveService;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function __construct(private LeaveService $service)
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Leave::with('leaveType')
            ->forUser($request->user()->id);

        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('leave_type_id')) $query->where('leave_type_id', $request->leave_type_id);
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('reason', 'like', '%'.$request->search.'%');
            });
        }
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('start_date', [$request->from, $request->to]);
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'oldest') $query->orderBy('start_date', 'asc');
        elseif ($sort === 'duration') $query->orderBy('number_of_days', 'desc');
        else $query->latest();

        $leaves = $query->paginate(10);
        $types = LeaveType::orderBy('name')->get();

        return view('employee.leaves.index', compact('leaves','types'));
    }

    public function create()
    {
        $types = LeaveType::orderBy('name')->get();
        return view('employee.leaves.create', compact('types'));
    }

    public function store(StoreLeaveRequest $request)
    {
        $days = $this->service->calculateDays($request->start_date, $request->end_date);

        $leave = Leave::create([
            'user_id' => $request->user()->id,
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'number_of_days' => $days,
            'reason' => $request->reason,
            'status' => 'draft',
        ]);

        if ($request->action === 'preview') {
            return view('employee.leaves.preview', compact('leave'));
        }

        if ($request->action === 'submit') {
            $this->service->submit($leave);
        }

        return redirect()->route('employee.leaves.index')->with('success', 'Leave saved.');
    }

    public function show(Leave $leave)
    {
        $this->authorize('view', $leave);
        return view('employee.leaves.show', compact('leave'));
    }

    public function edit(Leave $leave)
    {
        $this->authorize('update', $leave);
        $types = LeaveType::orderBy('name')->get();
        return view('employee.leaves.edit', compact('leave','types'));
    }

    public function update(UpdateLeaveRequest $request, Leave $leave)
    {
        $this->authorize('update', $leave);

        $days = $this->service->calculateDays($request->start_date, $request->end_date);

        $leave->update([
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'number_of_days' => $days,
            'reason' => $request->reason,
            'status' => 'draft',
        ]);

        if ($request->action === 'preview') {
            return view('employee.leaves.preview', compact('leave'));
        }

        if ($request->action === 'submit') {
            $this->service->submit($leave);
        }

        return redirect()->route('employee.leaves.index')->with('success', 'Leave updated.');
    }

    public function cancel(Leave $leave)
    {
        $this->authorize('cancel', $leave);
        $this->service->cancel($leave);

        return back()->with('success', 'Leave cancelled.');
    }

    public function dashboard(Request $request)
    {
        $balances = LeaveBalance::with('leaveType')
            ->where('user_id', $request->user()->id)->get();

        return view('employee.leaves.dashboard', compact('balances'));
    }

    public function calendar(Request $request)
    {
        return view('employee.leaves.calendar');
    }
}