<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillExchange extends Model
{
    protected $fillable = [
        'user_id', 'have_skill', 'have_desc', 'want_skill', 'want_desc', 'status',
        'matches_count',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
