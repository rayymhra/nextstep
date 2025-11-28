<?php
// app/Http/Controllers/BookmarkController.php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarkedCourses = auth()->user()->bookmarkedCourses()->paginate(12);
        return view('academy.bookmarks', compact('bookmarkedCourses'));
    }

    public function store(Course $course)
    {
        // Check if already bookmarked
        if (!auth()->user()->bookmarks()->where('course_id', $course->id)->exists()) {
            auth()->user()->bookmarks()->create([
                'course_id' => $course->id
            ]);
            
            return back()->with('success', 'Course bookmarked successfully!');
        }
        
        return back()->with('info', 'Course already bookmarked.');
    }

    public function destroy(Course $course)
    {
        auth()->user()->bookmarks()->where('course_id', $course->id)->delete();
        
        return back()->with('success', 'Course removed from bookmarks.');
    }
}