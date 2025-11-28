{{-- resources/views/portfolios/sections/socials/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Add Social Link</h4>
                    <a href="{{ route('portfolios.show', $portfolio) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Portfolio
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('portfolios.socials.store', $portfolio) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="platform" class="form-label">Platform *</label>
                            <select class="form-select @error('platform') is-invalid @enderror" id="platform" name="platform" required>
                                <option value="">Select a platform</option>
                                <option value="linkedin" {{ old('platform') == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                                <option value="github" {{ old('platform') == 'github' ? 'selected' : '' }}>GitHub</option>
                                <option value="twitter" {{ old('platform') == 'twitter' ? 'selected' : '' }}>Twitter</option>
                                <option value="facebook" {{ old('platform') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                <option value="instagram" {{ old('platform') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                <option value="youtube" {{ old('platform') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                <option value="website" {{ old('platform') == 'website' ? 'selected' : '' }}>Personal Website</option>
                                <option value="behance" {{ old('platform') == 'behance' ? 'selected' : '' }}>Behance</option>
                                <option value="dribbble" {{ old('platform') == 'dribbble' ? 'selected' : '' }}>Dribbble</option>
                                <option value="other" {{ old('platform') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('platform')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">Profile URL *</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                   id="url" name="url" value="{{ old('url') }}" 
                                   placeholder="https://linkedin.com/in/yourprofile" required>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('portfolios.show', $portfolio) }}" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add Social Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection