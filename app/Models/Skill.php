<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    protected $fillable = [
        'name', 'slug', 'category', 'icon', 'short_desc',
        'description', 'install_steps', 'config_code', 'use_cases',
        'pros', 'cons', 'author', 'repo_url',
        'avg_rating', 'install_count', 'likes_count', 'reviews_count', 'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'avg_rating' => 'decimal:2',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
