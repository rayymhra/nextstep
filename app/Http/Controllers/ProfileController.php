<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use Intervention\Image\Laravel\Facades\Image; // v3 import

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'bio' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:100'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
        ]);

        // Handle photo upload
        if ($request->hasFile('profile_photo')) {
            $this->uploadProfilePhoto($user, $request->file('profile_photo'));
        }

        // Update basic info
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'phone' => $request->phone,
            'location' => $request->location,
            'linkedin_url' => $request->linkedin_url,
            'github_url' => $request->github_url,
            'website_url' => $request->website_url,
        ]);

        // Update password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    public function show()
    {
        $user = Auth::user();
        $portfolios = $user->portfolios()->latest()->take(5)->get();
        $bookmarks = $user->bookmarkedCourses()->latest()->take(5)->get();

        return view('profile.show', compact('user', 'portfolios', 'bookmarks'));
    }

    public function deleteProfilePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = null;
            $user->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Profile photo removed successfully!');
    }

    private function uploadProfilePhoto($user, $file)
    {
        // delete old
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // create image instance
        $image = Image::read($file);

        // resize to 500x500 max, keeps ratio
        $image->cover(500, 500);

        // create filename (webp only)
        $filename = 'profile-photos/' . uniqid() . '.webp';

        // encode to webp using v3 encoder
        $encoded = $image->encode(new \Intervention\Image\Encoders\WebpEncoder(quality: 85));

        // store
        Storage::disk('public')->put($filename, $encoded);

        // save
        $user->profile_photo_path = $filename;
    }
}
