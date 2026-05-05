<?php

namespace App\Services;

use App\Models\Leave;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LeaveService
{
    public function calculateDays(string $start, string $end): int
    {
        return Carbon::parse($start)->diffInDays(Carbon::parse($end)) + 1;
    }

    public function validateOverlap(int $userId, string $start, string $end, ?int $ignoreLeaveId = null): void
    {
        $query = Leave::where('user_id', $userId)
            ->whereIn('status', ['pending','approved'])
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])
                  ->orWhereBetween('end_date', [$start, $end])
                  ->orWhere(function ($q2) use ($start, $end) {
                      $q2->where('start_date', '<=', $start)
                         ->where('end_date', '>=', $end);
                  });
            });

        if ($ignoreLeaveId) {
            $query->where('id', '!=', $ignoreLeaveId);
        }

        if ($query->exists()) {
            throw ValidationException::withMessages([
                'start_date' => 'Leave dates overlap with an existing approved/pending request.'
            ]);
        }
    }

    public function ensureBalance(int $userId, int $leaveTypeId, int $days): void
    {
        $balance = LeaveBalance::firstOrCreate(
            ['user_id' => $userId, 'leave_type_id' => $leaveTypeId],
            ['allocated' => LeaveType::findOrFail($leaveTypeId)->default_allocation, 'used' => 0]
        );

        if ($balance->remaining < $days) {
            throw ValidationException::withMessages([
                'leave_type_id' => 'Insufficient leave balance.'
            ]);
        }
    }

    public function submit(Leave $leave): Leave
    {
        $this->validateOverlap($leave->user_id, $leave->start_date, $leave->end_date, $leave->id);

        $leave->status = 'pending';
        $leave->submitted_at = now();
        $leave->save();

        return $leave;
    }

    public function approve(Leave $leave): Leave
    {
        return DB::transaction(function () use ($leave) {
            $this->ensureBalance($leave->user_id, $leave->leave_type_id, $leave->number_of_days);

            $balance = LeaveBalance::where('user_id', $leave->user_id)
                ->where('leave_type_id', $leave->leave_type_id)
                ->lockForUpdate()
                ->first();

            $balance->used += $leave->number_of_days;
            $balance->save();

            $leave->status = 'approved';
            $leave->approved_at = now();
            $leave->save();

            return $leave;
        });
    }

    public function reject(Leave $leave, ?string $remarks): Leave
    {
        $leave->status = 'rejected';
        $leave->admin_remarks = $remarks;
        $leave->rejected_at = now();
        $leave->save();

        return $leave;
    }

    public function cancel(Leave $leave): Leave
    {
        return DB::transaction(function () use ($leave) {
            if ($leave->status === 'approved') {
                $balance = LeaveBalance::where('user_id', $leave->user_id)
                    ->where('leave_type_id', $leave->leave_type_id)
                    ->lockForUpdate()
                    ->first();

                $balance->used = max(0, $balance->used - $leave->number_of_days);
                $balance->save();
            }

            $leave->status = 'cancelled';
            $leave->cancelled_at = now();
            $leave->save();

            return $leave;
        });
    }
}