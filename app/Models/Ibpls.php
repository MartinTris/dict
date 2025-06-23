<?php

namespace App\Models;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ibpls extends Model
{
    use HasFactory, BelongsToUser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ibpls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location',
        'operation',
        'status',
        'user_id'
    ];
}