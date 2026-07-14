<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiagnosisResult extends Model
{
    protected $fillable = [
        'user_id',
        'career_id',
        'education',
        'skills',
        'answers',
        'total_score',
        'conclusion',
        'cf_results',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'cf_results' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
}
