<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'start', 'end', 'description', 'location', 'assigned', 'project_id'];
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}


