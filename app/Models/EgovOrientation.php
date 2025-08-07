<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgovOrientation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date',
        'training_control_no',
        'event_name',
        'venue',
        'participants',
        'province',
        'municipality',
        'mode',
        'status',
        'no_of_attendees',
        'no_of_downloaded_and_verified',
        'male',
        'female',
        'link',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
