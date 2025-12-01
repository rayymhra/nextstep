<?php
// app/Models/Education.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations'; // Add this line

    protected $fillable = [
        'portfolio_id',
        'school',
        'degree',
        'start_year',
        'end_year',
        'description'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}