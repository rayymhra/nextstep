{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-4">Welcome to NextStep</h1>
            <p class="lead">Your gateway to the next step of your career</p>
        </div>
    </div>
    
    <div class="row">
        {{-- Portfolio Card --}}
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-file-alt fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Create CV/Portfolio</h5>
                    <p class="card-text">Build professional resumes and portfolios</p>
                    <a href="{{ route('portfolios.index') }}" class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </div>
        
        {{-- Academy Card --}}
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-graduation-cap fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Explore Academy</h5>
                    <p class="card-text">Curated courses for career growth</p>
                    <a href="{{ route('courses.index') }}" class="btn btn-success">Browse Courses</a>
                </div>
            </div>
        </div>
        
        {{-- Career Guide Card --}}
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-book fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Career Guide</h5>
                    <p class="card-text">Expert articles and career advice</p>
                    <a href="{{ route('articles.index') }}" class="btn btn-info">Read Articles</a>
                </div>
            </div>
        </div>
        
        {{-- Chatbot Card --}}
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-robot fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Career Chatbot</h5>
                    <p class="card-text">Get instant career guidance</p>
                    <a href="{{ route('chatbot') }}" class="btn btn-warning">Start Chat</a>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Recent Portfolios --}}
    @if($portfolios->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h3>Your Recent Portfolios</h3>
            <div class="row">
                @foreach($portfolios as $portfolio)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $portfolio->title }}</h5>
                            <p class="card-text">
                                <span class="badge bg-secondary">{{ ucfirst($portfolio->type) }}</span>
                            </p>
                            <a href="{{ route('portfolios.show', $portfolio) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    
    {{-- Add this to resources/views/dashboard.blade.php after the Recent Portfolios section --}}
    
    {{-- Featured Courses --}}
    @if($featuredCourses->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Featured Courses</h3>
                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-success">View All</a>
            </div>
            <div class="row">
                @foreach($featuredCourses as $course)
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <span class="badge bg-{{ $course->type == 'free' ? 'success' : 'warning' }} mb-2">
                                {{ ucfirst($course->type) }}
                            </span>
                            <h6 class="card-title">{{ Str::limit($course->title, 50) }}</h6>
                            <p class="card-text small text-muted">{{ Str::limit($course->description, 80) }}</p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-primary w-100">View Course</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    
    {{-- Recent Articles --}}
    @if($recentArticles->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Latest Career Guides</h3>
                <a href="{{ route('articles.index') }}" class="btn btn-sm btn-outline-info">View All</a>
            </div>
            <div class="row">
                @foreach($recentArticles as $article)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        @if($article->cover_image)
                        <img src="{{ $article->cover_image }}" class="card-img-top" 
                        alt="{{ $article->title }}" style="height: 150px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h6 class="card-title">{{ Str::limit($article->title, 60) }}</h6>
                            <p class="card-text small text-muted">{{ $article->excerpt }}</p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-info w-100">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection