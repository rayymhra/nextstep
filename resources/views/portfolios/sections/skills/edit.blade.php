{{-- resources/views/portfolios/sections/skills/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Skill</h4>
                    <a href="{{ route('portfolios.show', $skill->portfolio) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Portfolio
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('skills.update', $skill) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="skill_name" class="form-label">Skill Name *</label>
                            <input type="text" class="form-control @error('skill_name') is-invalid @enderror" 
                                   id="skill_name" name="skill_name" value="{{ old('skill_name', $skill->skill_name) }}" required>
                            @error('skill_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label">Skill Level *</label>
                            <select class="form-select @error('level') is-invalid @enderror" id="level" name="level" required>
                                <option value="">Select your proficiency level</option>
                                <option value="beginner" {{ old('level', $skill->level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ old('level', $skill->level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ old('level', $skill->level) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                <option value="expert" {{ old('level', $skill->level) == 'expert' ? 'selected' : '' }}>Expert</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('portfolios.show', $skill->portfolio) }}" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Skill</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection