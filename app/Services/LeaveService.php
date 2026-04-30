<?php

namespace App\Services;

use App\Models\Holiday;
use App\Models\Leave;
use App\Models\LeaveBalance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Validation\ValidationException;

class LeaveService
{
    public function calculateBusinessDays(string $startDate, string $endDate): int
    {
        $period = CarbonPeriod::create($startDate, $endDate);
        $holidays = Holiday::whereBetween('date', [$startDate, $endDate])
            ->where('is_working_day', false)
            ->pluck('date')
            ->map(fn ($d) => $d->format('Y-m-d'))
            ->toArray();

        $days = 0;
        foreach ($period as $date) {
            if ($date->isWeekend()) {
                continue;
            }
            if (in_array($date->format('Y-m-d'), $holidays, true)) {
                continue;
            }
            $days++;
        }

        return max(1, $days);
    }

    public function ensureNoOverlap(int $employeeId, string $startDate, string $endDate, ?int $ignoreLeaveId = null): void
    {
        $overlap = Leave::forEmployee($employeeId)
            ->whereIn('status', ['pending', 'approved', 'draft'])
            ->when($ignoreLeaveId, fn ($q) => $q->where('id', '!=', $ignoreLeaveId))
            ->where(function ($q) use ($startDate, $endDate) {
                $q->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($sub) use ($startDate, $endDate) {
                        $sub->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->exists();

        if ($overlap) {
            throw ValidationException::withMessages([
                'start_date' => 'This leave overlaps with an existing request.',
            ]);
        }
    }

    public function ensureBalance(int $employeeId, int $leaveTypeId, int $days): void
    {
        $balance = LeaveBalance::where('employee_id', $employeeId)
            ->where('leave_type_id', $leaveTypeId)
            ->first();

        $allocated = $balance?->allocated_days ?? 0;

        $used = Leave::forEmployee($employeeId)
            ->where('leave_type_id', $leaveTypeId)
            ->where('status', 'approved')
            ->sum('number_of_days');

        $remaining = $allocated - $used;

        if ($days > $remaining) {
            throw ValidationException::withMessages([
                'leave_type_id' => 'Requested days exceed your remaining balance.',
            ]);
        }
    }
}