{{-- resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- Left Column - Profile Card --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    {{-- Profile Photo --}}
                    {{-- In resources/views/profile/show.blade.php --}}
                    {{-- Update the profile photo section --}}
                    <div class="mb-4">
                        <div class="position-relative d-inline-block">
                            <img src="{{ $user->profile_photo_url }}" 
                            alt="Profile Photo" 
                            class="rounded-circle border shadow" 
                            style="width: 150px; height: 150px; object-fit: cover;">
                            @if($user->profile_photo_path)
                            <div class="position-absolute bottom-0 end-0">
                                <span class="badge bg-success">
                                    <i class="fas fa-check"></i> Custom Photo
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Basic Info --}}
                    <h3 class="mb-2">{{ $user->name }}</h3>
                    @if($user->role === 'admin')
                    <span class="badge bg-danger mb-3">Administrator</span>
                    @else
                    <span class="badge bg-primary mb-3">Member</span>
                    @endif
                    
                    @if($user->location)
                    <p class="text-muted mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>{{ $user->location }}
                    </p>
                    @endif
                    
                    {{-- Bio --}}
                    @if($user->bio)
                    <div class="mb-4">
                        <p class="card-text">{{ $user->bio }}</p>
                    </div>
                    @endif
                    
                    {{-- Contact Info --}}
                    <div class="mb-4">
                        @if($user->email)
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-envelope text-muted me-2"></i>
                            <span>{{ $user->email }}</span>
                        </div>
                        @endif
                        
                        @if($user->phone)
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-phone text-muted me-2"></i>
                            <span>{{ $user->phone }}</span>
                        </div>
                        @endif
                    </div>
                    
                    {{-- Social Links --}}
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        @if($user->linkedin_url)
                        <a href="{{ $user->linkedin_url }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        @endif
                        
                        @if($user->github_url)
                        <a href="{{ $user->github_url }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-circle">
                            <i class="fab fa-github"></i>
                        </a>
                        @endif
                        
                        @if($user->website_url)
                        <a href="{{ $user->website_url }}" target="_blank" class="btn btn-outline-success btn-sm rounded-circle">
                            <i class="fas fa-globe"></i>
                        </a>
                        @endif
                    </div>
                    
                    {{-- Action Buttons --}}
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Right Column - User Activity --}}
        <div class="col-md-8">
            {{-- Stats Overview --}}
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h2 class="text-primary">{{ $user->portfolios()->count() }}</h2>
                            <p class="text-muted mb-0">Portfolios</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h2 class="text-success">{{ $user->bookmarks()->count() }}</h2>
                            <p class="text-muted mb-0">Bookmarks</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h2 class="text-info">{{ $user->created_at->diffInDays(now()) }}</h2>
                            <p class="text-muted mb-0">Days Active</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Recent Portfolios --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Portfolios</h5>
                    <a href="{{ route('portfolios.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($portfolios->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($portfolios as $portfolio)
                        <a href="{{ route('portfolios.show', $portfolio) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $portfolio->title }}</h6>
                                    <small class="text-muted">{{ $portfolio->type }} • {{ $portfolio->template_name }} Template</small>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">{{ $portfolio->created_at->format('M d, Y') }}</span>
                                    <i class="fas fa-chevron-right ms-2 text-muted"></i>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No portfolios created yet.</p>
                        <a href="{{ route('portfolios.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Create Your First Portfolio
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            
            {{-- Recent Bookmarks --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Bookmarks</h5>
                    <a href="{{ route('bookmarks.index') }}" class="btn btn-sm btn-outline-success">View All</a>
                </div>
                <div class="card-body">
                    @if($bookmarks->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($bookmarks as $course)
                        <a href="{{ route('courses.show', $course) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ Str::limit($course->title, 50) }}</h6>
                                    <small class="text-muted">{{ $course->provider }} • {{ ucfirst($course->type) }} Course</small>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">{{ $course->created_at->format('M d') }}</span>
                                    <i class="fas fa-chevron-right ms-2 text-muted"></i>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-bookmark fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No bookmarked courses yet.</p>
                        <a href="{{ route('courses.index') }}" class="btn btn-success">
                            <i class="fas fa-graduation-cap me-2"></i>Browse Courses
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection