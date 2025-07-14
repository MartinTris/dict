<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class HRFormsCategory extends Model
{
    protected $table = 'hr_forms_categories';
    protected $fillable = ['name'];

    public function forms(): HasMany
    {
        return $this->hasMany(HRForm::class, 'category_id');
    }
}
