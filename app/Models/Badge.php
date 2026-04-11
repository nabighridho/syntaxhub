<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
        'name', 'icon', 'description', 'criteria',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')
                    ->withPivot('earned_at')
                    ->withTimestamps();
    }
}
