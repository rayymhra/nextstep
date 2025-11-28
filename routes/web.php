<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SocialLinkController;

Auth::routes();

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Portfolios
    Route::resource('portfolios', PortfolioController::class);
    
    // Nested Portfolio Resources
    Route::resource('portfolios.experiences', ExperienceController::class)->shallow();
    Route::resource('portfolios.educations', EducationController::class)->shallow();
    Route::resource('portfolios.skills', SkillController::class)->shallow();
    Route::resource('portfolios.projects', ProjectController::class)->shallow();
    Route::resource('portfolios.socials', SocialLinkController::class)->shallow();
    
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
    Route::get('/chatbot', function () {
        return view('chatbot.index');
    })->name('chatbot');
    
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot');
    Route::post('/chatbot/message', [ChatbotController::class, 'sendMessage'])->name('chatbot.message');
});