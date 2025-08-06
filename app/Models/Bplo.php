<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bplo extends Model
{
    use HasFactory;

    protected $fillable = [
        'province',
        'municipality_city',
        'bpco_status',
        'remarks',
        'congressional_district',
        'income_class',
        'user_id'
        
    ];

    public function user() { return $this->belongsTo(User::class); }
}