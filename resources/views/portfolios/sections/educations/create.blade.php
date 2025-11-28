{{-- resources/views/portfolios/sections/educations/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Add Education</h4>
                    <a href="{{ route('portfolios.show', $portfolio) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Portfolio
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('portfolios.educations.store', $portfolio) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="school" class="form-label">School/University *</label>
                            <input type="text" class="form-control @error('school') is-invalid @enderror" 
                                   id="school" name="school" value="{{ old('school') }}" required>
                            @error('school')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="degree" class="form-label">Degree/Program *</label>
                            <input type="text" class="form-control @error('degree') is-invalid @enderror" 
                                   id="degree" name="degree" value="{{ old('degree') }}" 
                                   placeholder="e.g., Bachelor of Science in Computer Science" required>
                            @error('degree')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_year" class="form-label">Start Year *</label>
                                <input type="number" class="form-control @error('start_year') is-invalid @enderror" 
                                       id="start_year" name="start_year" value="{{ old('start_year') }}" 
                                       min="1900" max="{{ date('Y') + 5 }}" required>
                                @error('start_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_year" class="form-label">End Year (or Expected)</label>
                                <input type="number" class="form-control @error('end_year') is-invalid @enderror" 
                                       id="end_year" name="end_year" value="{{ old('end_year') }}"
                                       min="1900" max="{{ date('Y') + 10 }}">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="currently_studying" name="currently_studying">
                                    <label class="form-check-label" for="currently_studying">
                                        Currently studying here
                                    </label>
                                </div>
                                @error('end_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4"
                                      placeholder="Relevant coursework, achievements, honors...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('portfolios.show', $portfolio) }}" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add Education</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('currently_studying').addEventListener('change', function() {
    const endYearField = document.getElementById('end_year');
    if (this.checked) {
        endYearField.disabled = true;
        endYearField.value = '';
    } else {
        endYearField.disabled = false;
    }
});
</script>
@endsection