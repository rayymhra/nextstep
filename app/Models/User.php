<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'bio',
        'phone',
        'location',
        'linkedin_url',
        'github_url',
        'website_url',
        'profile_photo_path'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'role' => 'user',
    ];

    // ... existing relationships ...

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }
        
        // Generate initials avatar as fallback
        $name = $this->name;
        $initials = '';
        $words = explode(' ', $name);
        
        foreach ($words as $word) {
            if (isset($word[0])) {
                $initials .= strtoupper($word[0]);
                if (strlen($initials) >= 2) break;
            }
        }
        
        $bgColor = $this->generateColorFromName($this->name);
        
        return "https://ui-avatars.com/api/?name=" . urlencode($initials) . 
               "&color=FFFFFF&background=" . $bgColor . "&size=200&bold=true";
    }

    private function generateColorFromName($name)
    {
        $hash = md5($name);
        $colors = [
            '667eea', '764ba2', 'f56565', 'ed8936', 'ecc94b',
            '48bb78', '38b2ac', '4299e1', '9f7aea', 'ed64a6'
        ];
        $index = hexdec(substr($hash, 0, 2)) % count($colors);
        return $colors[$index];
    }
}