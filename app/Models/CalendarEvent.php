<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'start', 'end', 'description'];
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
}
