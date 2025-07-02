<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = ['contract_name'];
    public function fw4as() {
        return $this->hasMany(Fw4a::class);
    }
}
