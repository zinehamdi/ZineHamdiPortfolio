<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title', 'subtitle', 'features', 'price_monthly', 'price_once', 'currency', 'delivery_days', 'is_featured', 'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'features' => 'array',
        'price_monthly' => 'integer',
        'price_once' => 'integer',
        'delivery_days' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}
