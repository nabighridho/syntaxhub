<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutorial extends Model
{
    protected $fillable = [
        'title', 'description', 'content', 'level',
        'category', 'department', 'estimated_minutes', 'order', 'icon', 'quiz'
    ];

    protected $casts = [
        'quiz' => 'array',
    ];

    public function progress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }
}
