<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UserDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Automatically add user_id when creating models
        Model::creating(function ($model) {
            // Check if this model has a user_id column
            if (Auth::check() && 
                method_exists($model, 'getFillable') && 
                in_array('user_id', $model->getFillable()) && 
                !isset($model->user_id)) {
                
                $model->user_id = Auth::id();
            }
        });
    }
}