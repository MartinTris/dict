<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveRejectLeaveRequest;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use App\Services\LeaveService;
use Illuminate\Http\Request;

class LeaveManagementController extends Controller
{
    public function __construct(private LeaveService $service)
    {
        $this->middleware(['auth','admin']);
    }

        public function index(Request $request)
    {
        $query = Leave::with(['user','leaveType']);

        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('employee_id')) $query->where('user_id', $request->employee_id);
        if ($request->filled('leave_type_id')) $query->where('leave_type_id', $request->leave_type_id);
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('start_date', [$request->from, $request->to]);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('reason', 'like', '%'.$request->search.'%')
                  ->orWhereHas('user', fn ($u) => $u->where('name','like','%'.$request->search.'%'));
            });
        }

        $leaves = $query->latest()->paginate(15);
        $types = LeaveType::orderBy('name')->get();
        $employees = User::orderBy('name')->get();

        return view('admin.leaves.index', compact('leaves','types','employees'));
    }

    public function show(Leave $leave)
    {
        return view('admin.leaves.show', compact('leave'));
    }

    public function action(ApproveRejectLeaveRequest $request, Leave $leave)
    {
        if ($leave->status !== 'pending') {
            return back()->withErrors('Only pending requests can be processed.');
        }

        if ($request->action === 'approve') {
            $this->service->approve($leave);
            return back()->with('success', 'Leave approved.');
        }

        $this->service->reject($leave, $request->admin_remarks);
        return back()->with('success', 'Leave rejected.');
    }

    public function employeeHistory(User $user)
    {
        $leaves = Leave::with('leaveType')->where('user_id', $user->id)->latest()->paginate(15);
        return view('admin.leaves.history', compact('user','leaves'));
    }
}