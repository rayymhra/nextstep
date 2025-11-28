{{-- resources/views/articles/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Article Header --}}
            <div class="text-center mb-5">
                @if($article->cover_image)
                    <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" 
                         class="img-fluid rounded mb-4" style="max-height: 400px; width: 100%; object-fit: cover;">
                @endif
                
                <h1 class="display-5 mb-3">{{ $article->title }}</h1>
                
                <div class="d-flex justify-content-center align-items-center text-muted">
                    <span class="me-3">
                        <i class="fas fa-clock"></i> {{ $article->reading_time }} min read
                    </span>
                    <span>
                        <i class="fas fa-calendar"></i> {{ $article->created_at->format('F d, Y') }}
                    </span>
                </div>
            </div>

            {{-- Article Content --}}
            <div class="card mb-5">
                <div class="card-body">
                    <article class="article-content">
                        {!! nl2br(e($article->content)) !!}
                    </article>
                </div>
            </div>

            {{-- Related Articles --}}
            @if($relatedArticles->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Related Articles</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($relatedArticles as $relatedArticle)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    @if($relatedArticle->cover_image)
                                        <img src="{{ $relatedArticle->cover_image }}" 
                                             class="rounded me-3" 
                                             style="width: 80px; height: 80px; object-fit: cover;" 
                                             alt="{{ $relatedArticle->title }}">
                                    @endif
                                    <div>
                                        <h6 class="mb-1">
                                            <a href="{{ route('articles.show', $relatedArticle) }}" 
                                               class="text-decoration-none">
                                                {{ Str::limit($relatedArticle->title, 50) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            {{ $relatedArticle->reading_time }} min read
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.article-content {
    line-height: 1.8;
    font-size: 1.1rem;
    color: #333;
}
.article-content p {
    margin-bottom: 1.5rem;
}
</style>
@endsection