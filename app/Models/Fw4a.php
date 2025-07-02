<?php

namespace App\Models;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fw4a extends Model
{
    use HasFactory, BelongsToUser;
     protected $fillable = [
        'site_code',
        'site_name',
        'region_id',
        'province_id',
        'district_id',
        'locality_id',
        'contract_status',
        'contract_id',
        'category_id',
        'contractor_id',
        'latitude',
        'longitude',
    ];
    
    public function region() { return $this->belongsTo(Region::class); }
    public function province() { return $this->belongsTo(Province::class); }
    public function district() { return $this->belongsTo(District::class); }
    public function locality() { return $this->belongsTo(Locality::class); }
    public function contract() { return $this->belongsTo(Contract::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function contractor() { return $this->belongsTo(Contractor::class); }
}

