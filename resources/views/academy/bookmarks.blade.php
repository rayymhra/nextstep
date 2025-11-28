{{-- resources/views/academy/bookmarks.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>My Bookmarked Courses</h1>
                    <p class="lead">Your saved courses for later</p>
                </div>
                <a href="{{ route('courses.index') }}" class="btn btn-primary">
                    <i class="fas fa-search"></i> Browse Courses
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookmarkedCourses->count() > 0)
        <div class="row">
            @foreach($bookmarkedCourses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header position-relative">
                            <span class="badge bg-{{ $course->type == 'free' ? 'success' : 'warning' }} position-absolute top-0 end-0 m-2">
                                {{ ucfirst($course->type) }}
                            </span>
                            <h6 class="mb-0">{{ Str::limit($course->title, 60) }}</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-2">
                                <i class="fas fa-building"></i> {{ $course->provider }}
                            </p>
                            <p class="card-text small">{{ Str::limit($course->description, 120) }}</p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-primary">
                                    View Details
                                </a>
                                <form action="{{ route('courses.unbookmark', $course) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove bookmark">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $bookmarkedCourses->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-bookmark fa-4x text-muted mb-3"></i>
            <h3>No Bookmarked Courses</h3>
            <p class="text-muted">Start browsing courses and bookmark your favorites!</p>
            <a href="{{ route('courses.index') }}" class="btn btn-primary">Browse Courses</a>
        </div>
    @endif
</div>
@endsection