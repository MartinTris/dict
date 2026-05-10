<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\CalendarEvent;
use App\Models\DailyTimeRecord;
use App\Models\HRForm;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request): View
    {
        $user = auth('employee')->user();
        $nowManila = Carbon::now('Asia/Manila');

        $monthStart = $nowManila->copy()->startOfMonth();
        $monthEnd = $nowManila->copy()->endOfMonth();

        $workedCount = DailyTimeRecord::where('user_id', $user->id)
            ->whereBetween('date', [$monthStart->toDateString(), $monthEnd->toDateString()])
            ->whereNotNull('clock_in')
            ->whereNotNull('clock_out')
            ->count();

        $workdays = 0;
        $cursor = $monthStart->copy();
        while ($cursor->lte($monthEnd)) {
            if ($cursor->isWeekday()) {
                $workdays++;
            }
            $cursor->addDay();
        }

        $attendanceRate = $workdays > 0
            ? round(($workedCount / $workdays) * 100, 1)
            : 0;

        $recentLeave = Leave::with('leaveType')
            ->forUser($user->id)
            ->latest('submitted_at')
            ->first();

        $leavesUsed = Leave::forUser($user->id)
            ->where('status', 'approved')
            ->whereYear('start_date', $nowManila->year)
            ->sum('number_of_days');

        $hrForms = HRForm::with('category')
            ->latest()
            ->take(5)
            ->get();

        $upcomingEvents = CalendarEvent::orderBy('start')
            ->where('start', '>=', $nowManila)
            ->take(5)
            ->get();

        return view('employee.dashboard', compact(
            'attendanceRate',
            'workedCount',
            'workdays',
            'recentLeave',
            'leavesUsed',
            'hrForms',
            'upcomingEvents'
        ));
    }
}