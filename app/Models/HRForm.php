<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HRForm extends Model
{
    use HasFactory;
    protected $table = 'hr_forms';
    protected $fillable = ['category_id', 'title', 'file_path', 'original_file_path'];


    public function category(): BelongsTo
    {
        return $this->belongsTo(HrFormsCategory::class, 'category_id');
    }
}
