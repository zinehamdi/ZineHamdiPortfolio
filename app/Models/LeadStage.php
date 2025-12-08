<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'label',
        'rank',
    ];

    protected $casts = [
        'rank' => 'integer',
    ];
}
