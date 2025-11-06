<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentChunk extends Model
{
    protected $fillable = [
        'title', 'slug', 'locale', 'body', 'vector'
    ];

    protected $casts = [
        'vector' => 'array',
    ];
}
