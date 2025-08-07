<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgovAssistances extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date',
        'province',
        'lgu',
        'name_of_requestee',
        'email_address',
        'contact_no',
        'system',
        'concern',
        'received_by',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
