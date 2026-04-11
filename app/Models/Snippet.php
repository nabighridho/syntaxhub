<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    protected $fillable = [
        'title', 'code', 'language', 'description',
        'annotations', 'category',
    ];

    protected $casts = [
        'annotations' => 'array',
    ];

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }
}
