<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'skills',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
        ];
    }
}
