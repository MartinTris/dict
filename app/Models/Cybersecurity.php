<?php

namespace App\Models;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cybersecurity extends Model
{
    use HasFactory, BelongsToUser;

    protected $fillable = [
        'date_conducted',
        'time_conducted',
        'organizer',
        'province',
        'activity_title',
        'type_of_activity',
        'mode_of_implementation',
        'zoom_link',
        'male_participants',
        'female_participants',
        'participant_details',
        'resource_person',
        'fb_posting',
        'number_of_engagement',
        'list_of_engaged_partners',
        'user_id'
    ];

    protected $appends = [
        'total_participants'
    ];

    public function getTotalParticipantsAttribute()
    {
        return $this->male_participants + $this->female_participants;
    }
}