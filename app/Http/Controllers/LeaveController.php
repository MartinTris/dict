<?php

namespace App\Http\Controllers;

use App\Http\Requests\Leave\PreviewLeaveRequest;
use App\Http\Requests\Leave\StoreLeaveRequest;
use App\Http\Requests\Leave\UpdateLeaveRequest;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Services\LeaveService;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function __construct(private LeaveService $leaveService)
    {
    }

    public function dashboard()
    {
        $employeeId = auth('employee')->id();

        $balances = LeaveBalance::with('type')
            ->where('employee_id', $employeeId)
            ->get()
            ->map(function ($balance) use ($employeeId) {
                $used = Leave::forEmployee($employeeId)
                    ->where('leave_type_id', $balance->leave_type_id)
                    ->where('status', 'approved')
                    ->sum('number_of_days');

                $balance->used_days = $used;
                return $balance;
            });

        $upcoming = Leave::forEmployee($employeeId)
            ->where('status', 'approved')
            ->whereDate('start_date', '>=', now()->toDateString())
            ->orderBy('start_date')
            ->limit(5)
            ->get();

        return view('employee.leaves.dashboard', compact('balances', 'upcoming'));
    }

    public function index(Request $request)
    {
        $employeeId = auth('employee')->id();

        $leaves = Leave::with('type')
            ->forEmployee($employeeId)
            ->status($request->get('status'))
            ->type($request->get('leave_type_id'))
            ->search($request->get('search'))
            ->dateRange($request->get('from'), $request->get('to'))
            ->sorted($request->get('sort'))
            ->paginate(10)
            ->withQueryString();

        $types = LeaveType::where('is_active', true)->get();

        return view('employee.leaves.index', compact('leaves', 'types'));
    }

    public function create()
    {
        $types = LeaveType::where('is_active', true)->get();

        return view('employee.leaves.create', compact('types'));
    }

    public function preview(PreviewLeaveRequest $request)
    {
        $days = $this->leaveService->calculateBusinessDays(
            $request->start_date,
            $request->end_date
        );

        $type = LeaveType::findOrFail($request->leave_type_id);

        return view('employee.leaves.preview', [
            'data' => $request->validated(),
            'days' => $days,
            'type' => $type,
        ]);
    }

    public function store(StoreLeaveRequest $request)
    {
        $employeeId = auth('employee')->id();
        $days = $this->leaveService->calculateBusinessDays($request->start_date, $request->end_date);

        if ($request->action === 'submit') {
            $this->leaveService->ensureNoOverlap($employeeId, $request->start_date, $request->end_date);
            $this->leaveService->ensureBalance($employeeId, $request->leave_type_id, $days);
        }

        $leave = Leave::create([
            'employee_id' => $employeeId,
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'number_of_days' => $days,
            'reason' => $request->reason,
            'status' => $request->action === 'submit' ? 'pending' : 'draft',
            'submitted_at' => $request->action === 'submit' ? now() : null,
        ]);

        return redirect()
            ->route('employee.leaves.show', $leave)
            ->with('success', $request->action === 'submit' ? 'Leave request submitted.' : 'Draft saved.');
    }

    public function show(Leave $leave)
    {
        $this->authorize('view', $leave);

        return view('employee.leaves.show', compact('leave'));
    }

    public function edit(Leave $leave)
    {
        $this->authorize('update', $leave);
        $types = LeaveType::where('is_active', true)->get();

        return view('employee.leaves.edit', compact('leave', 'types'));
    }

    public function update(UpdateLeaveRequest $request, Leave $leave)
    {
        $this->authorize('update', $leave);

        $employeeId = auth('employee')->id();
        $days = $this->leaveService->calculateBusinessDays($request->start_date, $request->end_date);

        if ($request->action === 'submit') {
            $this->leaveService->ensureNoOverlap($employeeId, $request->start_date, $request->end_date, $leave->id);
            $this->leaveService->ensureBalance($employeeId, $request->leave_type_id, $days);
        }

        $leave->update([
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'number_of_days' => $days,
            'reason' => $request->reason,
            'status' => $request->action === 'submit' ? 'pending' : 'draft',
            'submitted_at' => $request->action === 'submit' ? now() : null,
        ]);

        return redirect()
            ->route('employee.leaves.show', $leave)
            ->with('success', $request->action === 'submit' ? 'Leave request submitted.' : 'Draft updated.');
    }

    public function cancel(Leave $leave)
    {
        $this->authorize('cancel', $leave);

        $leave->update([
            'status' => 'rejected',
            'cancelled_at' => now(),
        ]);

        return redirect()
            ->route('employee.leaves.show', $leave)
            ->with('success', 'Leave request cancelled.');
    }

    public function calendar()
    {
        return view('employee.leaves.calendar');
    }

    public function calendarFetch()
    {
        $employeeId = auth('employee')->id();

        $leaves = Leave::forEmployee($employeeId)
            ->where('status', 'approved')
            ->get()
            ->map(function ($leave) {
                return [
                    'id' => $leave->id,
                    'title' => $leave->type->name . ' Leave',
                    'start' => $leave->start_date->toDateString(),
                    'end' => $leave->end_date->addDay()->toDateString(),
                    'color' => '#7FB3D5',
                ];
            });

        $holidays = Holiday::all()->map(function ($holiday) {
            return [
                'title' => $holiday->name,
                'start' => $holiday->date->toDateString(),
                'allDay' => true,
                'color' => '#FADBD8',
            ];
        });

        return response()->json($leaves->merge($holidays));
    }

    public function download(Leave $leave)
    {
        $this->authorize('view', $leave);

        $html = view('employee.leaves.pdf', compact('leave'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="leave-' . $leave->id . '.pdf"',
        ]);
    }
}