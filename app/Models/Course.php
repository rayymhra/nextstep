<?php
// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'provider',
        'type',
        'description',
        'url',
        'tags'
    ];

    protected $casts = [
        'tags' => 'array',
        'type' => 'string'
    ];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function isBookmarkedByUser()
    {
        return $this->bookmarks()->where('user_id', auth()->id())->exists();
    }
}