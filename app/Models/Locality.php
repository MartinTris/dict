<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;
    protected $fillable = ['locality_name', 'district_id'];
    public function district(){
        return $this->belongsTo(District::class);
    }
    
}
