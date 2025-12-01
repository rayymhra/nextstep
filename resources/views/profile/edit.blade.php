{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Profile</h4>
                        {{-- <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-eye"></i> View Profile
                        </a> --}}
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Profile Photo --}}
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img id="profile-photo-preview" 
                                     src="{{ auth()->user()->profile_photo_url }}" 
                                     alt="Profile Photo" 
                                     class="rounded-circle border shadow-sm" 
                                     style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;"
                                     onclick="document.getElementById('profile_photo').click()">
                                
                                <div class="position-absolute bottom-0 end-0">
                                    <label for="profile_photo" class="btn btn-sm btn-primary rounded-circle mb-0" style="cursor: pointer;">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                </div>
                                
                                @if(auth()->user()->profile_photo_path)
                                <div class="position-absolute top-0 end-0">
                                    <button type="button" class="btn btn-sm btn-danger rounded-circle" 
                                            data-bs-toggle="modal" data-bs-target="#deletePhotoModal">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @endif
                            </div>
                            
                            <input type="file" 
                                   id="profile_photo" 
                                   name="profile_photo" 
                                   class="d-none" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif"
                                   onchange="previewImage(this)">
                            
                            <p class="text-muted small mt-2">
                                Click image to upload. Max 5MB. JPG, PNG, GIF allowed.
                            </p>
                            
                            @error('profile_photo')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Basic Information --}}
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">Basic Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                           id="location" name="location" value="{{ old('location', auth()->user()->location) }}"
                                           placeholder="City, Country">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" 
                                          id="bio" name="bio" rows="3"
                                          placeholder="Tell us about yourself...">{{ old('bio', auth()->user()->bio) }}</textarea>
                                <div class="form-text">Brief introduction about yourself (max 500 characters).</div>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Social Links --}}
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">Social Links</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="linkedin_url" class="form-label">
                                        <i class="fab fa-linkedin text-primary me-2"></i>LinkedIn URL
                                    </label>
                                    <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" 
                                           id="linkedin_url" name="linkedin_url" 
                                           value="{{ old('linkedin_url', auth()->user()->linkedin_url) }}"
                                           placeholder="https://linkedin.com/in/username">
                                    @error('linkedin_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="github_url" class="form-label">
                                        <i class="fab fa-github text-dark me-2"></i>GitHub URL
                                    </label>
                                    <input type="url" class="form-control @error('github_url') is-invalid @enderror" 
                                           id="github_url" name="github_url" 
                                           value="{{ old('github_url', auth()->user()->github_url) }}"
                                           placeholder="https://github.com/username">
                                    @error('github_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="website_url" class="form-label">
                                    <i class="fas fa-globe text-success me-2"></i>Personal Website
                                </label>
                                <input type="url" class="form-control @error('website_url') is-invalid @enderror" 
                                       id="website_url" name="website_url" 
                                       value="{{ old('website_url', auth()->user()->website_url) }}"
                                       placeholder="https://yourwebsite.com">
                                @error('website_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Password Change --}}
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">Change Password</h5>
                            <p class="text-muted small mb-3">Leave password fields empty if you don't want to change your password.</p>
                            
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       id="current_password" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                           id="new_password" name="new_password">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" 
                                           id="new_password_confirmation" name="new_password_confirmation">
                                </div>
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Photo Modal --}}
@if(auth()->user()->profile_photo_path)
<div class="modal fade" id="deletePhotoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove Profile Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove your profile photo?</p>
                <p class="text-muted small">You can upload a new photo anytime.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('profile.photo.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove Photo</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<style>
.form-label {
    font-weight: 500;
}
#profile-photo-preview:hover {
    opacity: 0.9;
    transform: scale(1.02);
    transition: all 0.3s ease;
}
</style>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const preview = document.getElementById('profile-photo-preview');
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            // Show the delete button
            const deleteBtn = preview.parentElement.querySelector('.position-absolute.top-0.end-0');
            if (deleteBtn) {
                deleteBtn.style.display = 'block';
            }
        }
        
        reader.readAsDataURL(input.files[0]);
        
        // Show file info
        const file = input.files[0];
        const fileSize = (file.size / 1024 / 1024).toFixed(2); // MB
        const fileName = file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name;
        
        // Update the helper text
        const helperText = preview.nextElementSibling.nextElementSibling;
        helperText.innerHTML = `Selected: ${fileName} (${fileSize} MB)`;
    }
}

// Drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const preview = document.getElementById('profile-photo-preview');
    const fileInput = document.getElementById('profile_photo');
    
    preview.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.border = '3px dashed #007bff';
        this.style.opacity = '0.8';
    });
    
    preview.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.border = '';
        this.style.opacity = '1';
    });
    
    preview.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.border = '';
        this.style.opacity = '1';
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            previewImage(fileInput);
        }
    });
});
</script>
@endsection