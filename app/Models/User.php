<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

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

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    // This is the correct method name - it should match the relationship
    public function bookmarkedCourses()
    {
        return $this->belongsToMany(Course::class, 'bookmarks')
                    ->withTimestamps();
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            // Check if file exists
            if (Storage::disk('public')->exists($this->profile_photo_path)) {
                return asset('storage/' . $this->profile_photo_path);
            }
            
            // If WebP doesn't exist, try other formats
            $originalPath = str_replace('.webp', '.jpg', $this->profile_photo_path);
            if (Storage::disk('public')->exists($originalPath)) {
                return asset('storage/' . $originalPath);
            }
            
            $originalPath = str_replace('.webp', '.png', $this->profile_photo_path);
            if (Storage::disk('public')->exists($originalPath)) {
                return asset('storage/' . $originalPath);
            }
        }
        
        // Generate initials avatar as fallback
        return $this->generateAvatarUrl();
    }

    public function getThumbnailPhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return $this->profile_photo_url;
        }
        
        return $this->generateAvatarUrl('64');
    }

    private function generateAvatarUrl($size = '200')
    {
        $name = $this->name;
        $initials = '';
        $words = explode(' ', $name);
        
        foreach ($words as $word) {
            if (isset($word[0])) {
                $initials .= strtoupper($word[0]);
                if (strlen($initials) >= 2) break;
            }
        }
        
        if (empty($initials)) {
            $initials = substr(strtoupper($this->email), 0, 2);
        }
        
        $bgColor = $this->generateColorFromName($this->name);
        
        return "https://ui-avatars.com/api/?name=" . urlencode($initials) . 
               "&color=FFFFFF&background=" . $bgColor . "&size=" . $size . "&bold=true&font-size=0.5";
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

    public function deleteProfilePhoto()
    {
        if ($this->profile_photo_path) {
            Storage::disk('public')->delete($this->profile_photo_path);
            
            // Also delete other format versions
            $extensions = ['.jpg', '.jpeg', '.png', '.gif'];
            foreach ($extensions as $ext) {
                $path = str_replace('.webp', $ext, $this->profile_photo_path);
                Storage::disk('public')->delete($path);
            }
            
            $this->profile_photo_path = null;
            $this->save();
        }
    }
}