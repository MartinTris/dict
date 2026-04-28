<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DailyTimeRecordController extends Controller
{
    /**
     * Display today's record and historical records.
     */
    public function index(Request $request): View
    {
        $user = auth('employee')->user();

        $nowManila = Carbon::now('Asia/Manila');
        $today = $nowManila->toDateString();

        $todayRecord = DailyTimeRecord::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        $history = DailyTimeRecord::where('user_id', $user->id)
            ->orderByDesc('date')
            ->paginate(20);

        // Debug: log what we're sending to view
        \Log::info('DTR index', [
            'user_id' => $user->id,
            'today' => $today,
            'todayRecord' => $todayRecord,
            'history_count' => $history->count(),
        ]);

        return view('dtr.index', [
            'todayRecord' => $todayRecord,
            'history' => $history,
            'nowManila' => $nowManila,
        ]);
    }

    /**
     * Clock in for today.
     *
     * Rules:
     * - only once per day
     * - prevent duplicate entries
     */
    public function clockIn(Request $request): RedirectResponse
    {
        $user = auth('employee')->user();
        $now = Carbon::now('Asia/Manila');
        $today = $now->toDateString();

        $record = DailyTimeRecord::firstOrNew([
            'user_id' => $user->id,
            'date' => $today,
        ]);

        // Prevent multiple clock-ins for same day.
        if ($record->clock_in !== null) {
            return back()->with('error', 'You have already clocked in today.');
        }

        $record->clock_in = $now;
        $record->save();

        return back()->with('success', 'Clock-in successful.');
    }

    /**
     * Clock out for today.
     *
     * Rules:
     * - must clock in first
     * - only once per day
     * - compute total_hours
     */
    public function clockOut(Request $request): RedirectResponse
    {
        $user = auth('employee')->user();
        $now = Carbon::now('Asia/Manila');
        $today = $now->toDateString();

        $record = DailyTimeRecord::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        if (!$record || $record->clock_in === null) {
            return back()->with('error', 'You must clock in before clocking out.');
        }

        if ($record->clock_out !== null) {
            return back()->with('error', 'You have already clocked out today.');
        }

        $clockIn = Carbon::parse($record->clock_in, 'Asia/Manila');
        $clockOut = $now;

        // Time calculation:
        // diffInMinutes gives exact elapsed whole minutes between in/out.
        // Divide by 60 to convert to fractional hours.
        $totalHours = $clockOut->diffInMinutes($clockIn) / 60;

        $record->clock_out = $clockOut;
        $record->total_hours = round($totalHours, 2);
        $record->save();

        return back()->with('success', 'Clock-out successful.');
    }
}
