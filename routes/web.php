<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ChatbotController;

// Landing Page (Public)
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Authentication Routes
Auth::routes(['register' => true]);

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Portfolios
    Route::resource('portfolios', PortfolioController::class);
    
    // Nested Portfolio Resources
Route::prefix('portfolios/{portfolio}')->group(function () {
    Route::resource('experiences', ExperienceController::class)->except(['index', 'show']);
    Route::resource('educations', EducationController::class)->except(['index', 'show']);
    Route::resource('skills', SkillController::class)->except(['index', 'show']);
    Route::resource('projects', ProjectController::class)->except(['index', 'show']);
    Route::resource('socials', SocialLinkController::class)->except(['index', 'show']);
});

// Individual resource routes for editing/deleting
Route::resource('experiences', ExperienceController::class)->only(['edit', 'update', 'destroy']);
Route::resource('educations', EducationController::class)->only(['edit', 'update', 'destroy']);
Route::resource('skills', SkillController::class)->only(['edit', 'update', 'destroy']);
Route::resource('projects', ProjectController::class)->only(['edit', 'update', 'destroy']);
Route::resource('socials', SocialLinkController::class)->only(['edit', 'update', 'destroy']);
    
    // Academy
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/courses/{course}/bookmark', [BookmarkController::class, 'store'])->name('courses.bookmark');
    Route::delete('/courses/{course}/bookmark', [BookmarkController::class, 'destroy'])->name('courses.unbookmark');
    
    // Career Guide
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    
    // Chatbot
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot');
    Route::post('/chatbot/message', [ChatbotController::class, 'sendMessage'])->name('chatbot.message');
});

// Redirect /home to /dashboard for logged-in users
Route::get('/home', function () {
    return redirect()->route('dashboard');
});