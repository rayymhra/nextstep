{{-- resources/views/portfolios/sections/experiences/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>Work Experiences</h1>
                    <p class="lead">for {{ $portfolio->title }}</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('portfolios.experiences.create', $portfolio) }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Experience
                    </a>
                    <a href="{{ route('portfolios.show', $portfolio) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Portfolio
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if($experiences->count() > 0)
        <div class="row">
            @foreach($experiences as $experience)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $experience->position }}</h5>
                            <h6 class="card-subtitle mb-2 text-primary">{{ $experience->company }}</h6>
                            <p class="card-text text-muted">
                                {{ $experience->start_date->format('M Y') }} - 
                                {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}
                            </p>
                            @if($experience->description)
                                <p class="card-text">{{ Str::limit($experience->description, 150) }}</p>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100">
                                <a href="{{ route('experiences.edit', $experience) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('experiences.destroy', $experience) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete this experience?')">
                                        <i class="fas fa-trash"></i> Delete
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
            <i class="fas fa-briefcase fa-4x text-muted mb-3"></i>
            <h3>No Experiences Added</h3>
            <p class="text-muted">Start by adding your first work experience.</p>
            <a href="{{ route('portfolios.experiences.create', $portfolio) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Experience
            </a>
        </div>
    @endif
</div>
@endsection