<?php

namespace App\Policies;

use App\Models\Leave;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Contracts\Auth\Authenticatable;

class LeavePolicy
{
    public function view(User|UserEmployee $user, Leave $leave): bool
    {
        return $user->is_admin || $leave->user_id === $user->id;
    }

    public function update(User|UserEmployee $user, Leave $leave): bool
    {
        return $leave->user_id === $user->id && in_array($leave->status, ['draft','pending']);
    }

    public function cancel(User|UserEmployee $user, Leave $leave): bool
    {
        return $leave->user_id === $user->id && in_array($leave->status, ['pending','approved']);
    }

    public function approve(User|UserEmployee $user): bool
    {
        return $user->is_admin === true;
    }
}