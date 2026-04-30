<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'leave_type_id', 'allocated_days'];

    public function employee()
    {
        return $this->belongsTo(UserEmployee::class, 'employee_id');
    }

    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function getRemainingDaysAttribute(): int
    {
        return max(0, $this->allocated_days - ($this->used_days ?? 0));
    }
}