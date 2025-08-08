<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pnpki extends Model
{
    use HasFactory;

      protected $fillable = [
        'date_conducted',
        'time_conducted',
        'organizer',
        'province',
        'municipality',
        'district',
        'activity_title',
        'type_of_activity',
        'mode_of_implementation',
        'zoom_link',
        'male_participants',
        'female_participants',
        'total_participants',
        'participant_details',
        'resource_person',
        'fb_posting',
        'number_of_engagement',
        'list_of_engaged_partners',
        'user_id'
    ];

    public function user() { return $this->belongsTo(User::class); }
}