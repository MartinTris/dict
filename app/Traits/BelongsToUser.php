<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    /**
     * Boot the trait.
     */
    protected static function bootBelongsToUser()
    {
        // Add a global scope to filter by user_id
        static::addGlobalScope('user', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('user_id', Auth::id());
            }
        });
        
        // Set user_id on creating
        static::creating(function ($model) {
            if (!isset($model->user_id) && Auth::check()) {
                $model->user_id = Auth::id();
            }
        });
    }
    
    /**
     * Get the user that owns this record.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}