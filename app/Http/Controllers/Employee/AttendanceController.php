<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DailyTimeRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $user = auth('employee')->user();
        $nowManila = Carbon::now('Asia/Manila');

        $monthParam = $request->query('month', $nowManila->format('Y-m'));
        $selectedMonth = Carbon::createFromFormat('Y-m', $monthParam, 'Asia/Manila')->startOfMonth();

        $start = $selectedMonth->copy()->startOfMonth();
        $end = $selectedMonth->copy()->endOfMonth();

        $records = DailyTimeRecord::where('user_id', $user->id)
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->whereNotNull('clock_in')
            ->whereNotNull('clock_out')
            ->get();

        $workedDates = $records->pluck('date')
            ->map(fn ($date) => Carbon::parse($date)->format('Y-m-d'))
            ->values()
            ->all();

        $workedCount = count($workedDates);

        $weeks = [];
        $week = array_fill(0, 7, null);

        $cursor = $start->copy();
        $dayIndex = $start->dayOfWeek; // 0 = Sunday

        while ($cursor->lte($end)) {
            $week[$dayIndex] = $cursor->copy();

            if ($dayIndex === 6) {
                $weeks[] = $week;
                $week = array_fill(0, 7, null);
                $dayIndex = 0;
            } else {
                $dayIndex++;
            }

            $cursor->addDay();
        }

        if (collect($week)->filter()->isNotEmpty()) {
            $weeks[] = $week;
        }

        $months = collect(range(1, 12))->map(function ($month) use ($selectedMonth) {
            return Carbon::create($selectedMonth->year, $month, 1, 0, 0, 0, 'Asia/Manila');
        });

        return view('employee.attendance.index', [
            'selectedMonth' => $selectedMonth,
            'months' => $months,
            'weeks' => $weeks,
            'workedDates' => $workedDates,
            'workedCount' => $workedCount,
        ]);
    }
}