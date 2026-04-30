<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserEmployee extends Authenticatable
{
    use Notifiable;

    protected $table = 'user_employee';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'employee_id');
    }

    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalance::class, 'employee_id');
    }
}