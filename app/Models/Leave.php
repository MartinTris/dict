<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'start_date',
        'end_date',
        'number_of_days',
        'reason',
        'status',
        'submitted_at',
        'cancelled_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'submitted_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(UserEmployee::class, 'employee_id');
    }

    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function scopeForEmployee(Builder $query, int $employeeId): Builder
    {
        return $query->where('employee_id', $employeeId);
    }

    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeType(Builder $query, ?int $typeId): Builder
    {
        return $typeId ? $query->where('leave_type_id', $typeId) : $query;
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $search
            ? $query->where(function (Builder $q) use ($search) {
                $q->where('reason', 'like', "%{$search}%")
                    ->orWhereHas('type', function (Builder $t) use ($search) {
                        $t->where('name', 'like', "%{$search}%");
                    });
            })
            : $query;
    }

    public function scopeDateRange(Builder $query, ?string $from, ?string $to): Builder
    {
        if ($from) {
            $query->whereDate('start_date', '>=', $from);
        }
        if ($to) {
            $query->whereDate('end_date', '<=', $to);
        }
        return $query;
    }

    public function scopeSorted(Builder $query, ?string $sort): Builder
    {
        return match ($sort) {
            'oldest' => $query->orderBy('start_date'),
            'duration' => $query->orderByDesc('number_of_days'),
            default => $query->orderByDesc('start_date'),
        };
    }

    public function getDisplayStatusAttribute(): string
    {
        return $this->cancelled_at ? 'Cancelled' : ucfirst($this->status);
    }

    public function scopeFilter($query, array $filters)
{
    if (!empty($filters['status'])) {
        $query->where('status', $filters['status']);
    }
    if (!empty($filters['from'])) {
        $query->whereDate('start_date', '>=', $filters['from']);
    }
    if (!empty($filters['to'])) {
        $query->whereDate('end_date', '<=', $filters['to']);
    }
    if (!empty($filters['search'])) {
        $query->where('reason', 'like', '%' . $filters['search'] . '%');
    }

    return $query;
}
}