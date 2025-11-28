{{-- resources/views/academy/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            {{-- Course Header --}}
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-{{ $course->type == 'free' ? 'success' : 'warning' }} mb-2">
                                {{ ucfirst($course->type) }} Course
                            </span>
                            <h1 class="h3 mb-2">{{ $course->title }}</h1>
                            <p class="text-muted mb-0">
                                <i class="fas fa-building"></i> {{ $course->provider }}
                            </p>
                        </div>
                        <div class="btn-group">
                            @if($isBookmarked)
                                <form action="{{ route('courses.unbookmark', $course) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Remove bookmark">
                                        <i class="fas fa-bookmark"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('courses.bookmark', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary" title="Bookmark this course">
                                        <i class="far fa-bookmark"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ $course->url }}" target="_blank" class="btn btn-primary btn-lg">
                            <i class="fas fa-external-link-alt"></i> 
                            {{ $course->type == 'free' ? 'Enroll for Free' : 'View Course' }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- Course Description --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Course Description</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $course->description }}</p>
                </div>
            </div>

            {{-- Course Tags --}}
            @if($course->tags && is_array($course->tags))
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Skills Covered</h5>
                </div>
                <div class="card-body">
                    @foreach($course->tags as $tag)
                        <span class="badge bg-light text-dark mb-2 me-2 p-2">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            {{-- Related Courses --}}
            @if($relatedCourses->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Related Courses</h6>
                </div>
                <div class="card-body">
                    @foreach($relatedCourses as $relatedCourse)
                        <div class="mb-3 pb-3 border-bottom">
                            <h6 class="mb-1">
                                <a href="{{ route('courses.show', $relatedCourse) }}" class="text-decoration-none">
                                    {{ Str::limit($relatedCourse->title, 50) }}
                                </a>
                            </h6>
                            <p class="small text-muted mb-1">{{ $relatedCourse->provider }}</p>
                            <span class="badge bg-{{ $relatedCourse->type == 'free' ? 'success' : 'warning' }} small">
                                {{ ucfirst($relatedCourse->type) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Quick Actions --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-arrow-left"></i> Back to Courses
                    </a>
                    <a href="{{ route('bookmarks.index') }}" class="btn btn-outline-success w-100 mb-2">
                        <i class="fas fa-bookmark"></i> My Bookmarks
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection