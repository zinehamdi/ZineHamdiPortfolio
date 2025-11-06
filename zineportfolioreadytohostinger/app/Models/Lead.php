<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'company', 'locale', 'business_type',
        'need_website', 'need_content', 'need_ai', 'need_seo',
        'budget_range', 'notes', 'package_id',
        'price_estimate_min', 'price_estimate_max', 'currency',
        'stage', 'source',
    ];

    protected $casts = [
        'need_website' => 'boolean',
        'need_content' => 'boolean',
        'need_ai' => 'boolean',
        'need_seo' => 'boolean',
        'price_estimate_min' => 'integer',
        'price_estimate_max' => 'integer',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
 
