<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Course;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('user_id', auth()->id())->latest()->take(3)->get();
        $featuredCourses = Course::latest()->take(4)->get();
        $recentArticles = Article::latest()->take(3)->get();
        
        return view('dashboard', compact('portfolios', 'featuredCourses', 'recentArticles'));
    }
}