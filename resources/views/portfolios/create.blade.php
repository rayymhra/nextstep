{{-- resources/views/portfolios/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Create New Portfolio</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('portfolios.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Portfolio Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Portfolio Type *</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="resume" {{ old('type') == 'resume' ? 'selected' : '' }}>Resume</option>
                                <option value="cv" {{ old('type') == 'cv' ? 'selected' : '' }}>CV</option>
                                <option value="portfolio" {{ old('type') == 'portfolio' ? 'selected' : '' }}>Portfolio</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="template_name" class="form-label">Template *</label>
                            <select class="form-select @error('template_name') is-invalid @enderror" id="template_name" name="template_name" required>
                                <option value="">Select Template</option>
                                <option value="modern" {{ old('template_name') == 'modern' ? 'selected' : '' }}>Modern</option>
                                <option value="classic" {{ old('template_name') == 'classic' ? 'selected' : '' }}>Classic</option>
                                <option value="creative" {{ old('template_name') == 'creative' ? 'selected' : '' }}>Creative</option>
                                <option value="minimal" {{ old('template_name') == 'minimal' ? 'selected' : '' }}>Minimal</option>
                            </select>
                            @error('template_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Create Portfolio</button>
                            <a href="{{ route('portfolios.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection