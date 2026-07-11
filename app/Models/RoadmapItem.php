<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoadmapItem extends Model
{
    protected $fillable = [
        'career_id',
        'title',
        'description',
        'order',
    ];

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(RoadmapProgress::class);
    }
}
