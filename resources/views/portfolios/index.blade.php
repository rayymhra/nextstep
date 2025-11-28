{{-- resources/views/portfolios/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>My Portfolios</h1>
                <a href="{{ route('portfolios.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create New Portfolio
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($portfolios->count() > 0)
        <div class="row">
            @foreach($portfolios as $portfolio)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $portfolio->title }}</h5>
                            <p class="card-text">
                                <span class="badge bg-secondary">{{ ucfirst($portfolio->type) }}</span>
                                <span class="badge bg-light text-dark">{{ $portfolio->template_name }} Template</span>
                            </p>
                            <p class="card-text text-muted">
                                <small>Created {{ $portfolio->created_at->diffForHumans() }}</small>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100">
                                <a href="{{ route('portfolios.show', $portfolio) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('portfolios.edit', $portfolio) }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('portfolios.destroy', $portfolio) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
            <h3>No Portfolios Yet</h3>
            <p class="text-muted">Create your first portfolio to get started!</p>
            <a href="{{ route('portfolios.create') }}" class="btn btn-primary">Create Portfolio</a>
        </div>
    @endif
</div>
@endsection