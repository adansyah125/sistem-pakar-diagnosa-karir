<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rule extends Model
{
    protected $fillable = [
        'question_id',
        'career_id',
        'min_score',
        'cf',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(DiagnosisQuestion::class);
    }

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
}
