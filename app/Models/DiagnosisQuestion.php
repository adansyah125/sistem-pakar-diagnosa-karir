<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiagnosisQuestion extends Model
{
    protected $fillable = [
        'career_id',
        'question',
        'options',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
}
