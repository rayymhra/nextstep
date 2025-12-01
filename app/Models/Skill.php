<?php
// app/Models/Skill.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skills'; // Add this line

    protected $fillable = [
        'portfolio_id',
        'skill_name',
        'level'
    ];

    protected $casts = [
        'level' => 'string'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}