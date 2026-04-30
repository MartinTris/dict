<?php

namespace App\Policies;

use App\Models\Leave;
use App\Models\UserEmployee;
use Illuminate\Auth\Access\Response;

class LeavePolicy
{
    public function view(UserEmployee $user, Leave $leave): bool
    {
        return $leave->employee_id === $user->id;
    }

    public function update(UserEmployee $user, Leave $leave): bool
    {
        return $leave->employee_id === $user->id && in_array($leave->status, ['draft', 'pending'], true);
    }

    public function cancel(UserEmployee $user, Leave $leave): bool
    {
        return $leave->employee_id === $user->id && $leave->status === 'pending';
    }
}
