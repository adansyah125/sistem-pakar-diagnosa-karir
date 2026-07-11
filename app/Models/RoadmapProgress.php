<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoadmapProgress extends Model
{
    protected $fillable = [
        'user_id',
        'roadmap_item_id',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function roadmapItem(): BelongsTo
    {
        return $this->belongsTo(RoadmapItem::class);
    }
}
