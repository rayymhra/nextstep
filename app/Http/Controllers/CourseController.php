<?php
// app/Http/Controllers/CourseController.php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();
        
        // Filter by type
        if ($request->has('type') && in_array($request->type, ['free', 'paid'])) {
            $query->where('type', $request->type);
        }
        
        // Filter by provider
        if ($request->has('provider') && $request->provider) {
            $query->where('provider', 'like', '%' . $request->provider . '%');
        }
        
        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('provider', 'like', '%' . $request->search . '%');
            });
        }
        
        $courses = $query->latest()->paginate(12);
        $providers = Course::distinct()->pluck('provider');
        
        return view('academy.index', compact('courses', 'providers'));
    }

    public function show(Course $course)
    {
        $relatedCourses = Course::where('id', '!=', $course->id)
            ->where(function($query) use ($course) {
                $query->where('provider', $course->provider)
                      ->orWhere('type', $course->type);
            })
            ->limit(4)
            ->get();
            
        $isBookmarked = auth()->user()->bookmarks()
            ->where('course_id', $course->id)
            ->exists();
            
        return view('academy.show', compact('course', 'relatedCourses', 'isBookmarked'));
    }
}