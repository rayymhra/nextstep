{{-- resources/views/academy/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>Course Academy</h1>
                    <p class="lead">Curated courses for your career growth</p>
                </div>
                <a href="{{ route('bookmarks.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-bookmark"></i> My Bookmarks
                </a>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('courses.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search courses..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="type" class="form-select">
                            <option value="">All Types</option>
                            <option value="free" {{ request('type') == 'free' ? 'selected' : '' }}>Free</option>
                            <option value="paid" {{ request('type') == 'paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="provider" class="form-select">
                            <option value="">All Providers</option>
                            @foreach($providers as $provider)
                                <option value="{{ $provider }}" {{ request('provider') == $provider ? 'selected' : '' }}>
                                    {{ $provider }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Courses Grid --}}
    @if($courses->count() > 0)
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 course-card">
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
                            
                            @if($course->tags && is_array($course->tags))
                                <div class="mb-2">
                                    @foreach(array_slice($course->tags, 0, 3) as $tag)
                                        <span class="badge bg-light text-dark small">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-primary">
                                    View Details
                                </a>
                                <small class="text-muted">
                                    {{ $course->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $courses->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-graduation-cap fa-4x text-muted mb-3"></i>
            <h3>No Courses Found</h3>
            <p class="text-muted">Try adjusting your search filters.</p>
            <a href="{{ route('courses.index') }}" class="btn btn-primary">Clear Filters</a>
        </div>
    @endif
</div>

<style>
.course-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
</style>
@endsection