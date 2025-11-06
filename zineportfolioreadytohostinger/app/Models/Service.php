<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title', 'summary', 'body', 'icon', 'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'summary' => 'array',
        'body' => 'array',
        'is_active' => 'boolean',
    ];
}
