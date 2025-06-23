<?php

namespace App\Models;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tech4ed extends Model
{
    use HasFactory, BelongsToUser;

    protected $fillable = [
        'congressional_district',
        'municipality',
        'specific_center_location',
        'center_name',
        'center_model',
        'cm_name',
        'cm_email',
        'cm_mobile',
        'cm_sex',
        'date_of_launching',
        'operational',
        'with_donation',
        'type_of_donation',
        'user_id'
    ];
}