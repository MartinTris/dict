<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bplo extends Model
{
    use HasFactory, BelongsToUser;

    protected $fillable = [
        'province',
        'municipality_city',
        'bpco_status',
        'remarks',
        'congressional_district',
        'income_class',
        'user_id'
        
    ];
}