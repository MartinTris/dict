<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Leave extends Model
{
    protected $fillable = [
        'user_id','leave_type_id','start_date','end_date',
        'number_of_days','reason','status','admin_remarks',
        'submitted_at','approved_at','rejected_at','cancelled_at'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function scopeForUser(Builder $q, int $userId): Builder
    {
        return $q->where('user_id', $userId);
    }

    public function getDateRangeAttribute(): string
    {
        return $this->start_date->format('Y-m-d').' to '.$this->end_date->format('Y-m-d');
    }
}