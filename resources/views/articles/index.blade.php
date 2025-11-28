{{-- resources/views/articles/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>Career Guide</h1>
                    <p class="lead">Expert advice and career insights</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Search --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('articles.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search articles..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Articles Grid --}}
    @if($articles->count() > 0)
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 article-card">
                        @if($article->cover_image)
                            <img src="{{ $article->cover_image }}" class="card-img-top" 
                                 alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($article->title, 70) }}</h5>
                            <p class="card-text text-muted small">
                                {{ $article->excerpt }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> {{ $article->reading_time }} min read
                                </small>
                                <small class="text-muted">
                                    {{ $article->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-primary w-100">
                                Read Article
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
            <h3>No Articles Found</h3>
            <p class="text-muted">Try adjusting your search terms.</p>
            <a href="{{ route('articles.index') }}" class="btn btn-primary">Clear Search</a>
        </div>
    @endif
</div>

<style>
.article-card {
    transition: transform 0.2s;
}
.article-card:hover {
    transform: translateY(-5px);
}
</style>
@endsection