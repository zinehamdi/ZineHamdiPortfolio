<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'locale',
        'business_type',
        'needs',
        'budget_range',
        'notes',
        'package_id',
        'price_estimate_min',
        'price_estimate_max',
        'currency',
        'lead_stage_id',
        'source',
        'metadata',
    ];

    protected $casts = [
        'needs' => 'array',
        'metadata' => 'array',
        'price_estimate_min' => 'integer',
        'price_estimate_max' => 'integer',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
 
