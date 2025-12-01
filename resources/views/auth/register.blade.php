@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-80">
        <div class="col-md-10 col-lg-8">
            <div class="card border-0 shadow-lg overflow-hidden">
                <div class="row g-0">
                    <!-- Left Side - Illustration/Info -->
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="h-100 p-5 d-flex flex-column justify-content-center gradient-bg text-white position-relative">
                            <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
                                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.3) 0%, transparent 50%);"></div>
                            </div>
                            
                            <div class="position-relative z-1">
                                <h2 class="display-6 fw-bold mb-4">Start Your Career Journey</h2>
                                <p class="mb-4">Join thousands of professionals who have transformed their careers with NextStep.</p>
                                
                                <div class="features-list">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="feature-check bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px;">
                                            <i class="fas fa-check fa-xs"></i>
                                        </div>
                                        <span>Professional portfolio builder</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="feature-check bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px;">
                                            <i class="fas fa-check fa-xs"></i>
                                        </div>
                                        <span>AI-powered career guidance</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="feature-check bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px;">
                                            <i class="fas fa-check fa-xs"></i>
                                        </div>
                                        <span>Expert-led career courses</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="feature-check bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px;">
                                            <i class="fas fa-check fa-xs"></i>
                                        </div>
                                        <span>Personalized job recommendations</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side - Registration Form -->
                    <div class="col-lg-6">
                        <div class="p-4 p-md-5">
                            <div class="text-center mb-4">
                                <a href="/" class="text-decoration-none">
                                    <h3 class="fw-bold mb-0 gradient-text">
                                        <i class="fas fa-step-forward me-2"></i>NextStep
                                    </h3>
                                </a>
                                <p class="text-muted mt-2">Create your account</p>
                            </div>
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    Please fix the following errors:
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('register') }}" class="mt-4">
                                @csrf
                                
                                <!-- Full Name -->
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-medium d-flex align-items-center">
                                        <i class="fas fa-user me-2 text-primary"></i>
                                        Full Name
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input id="name" type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               required 
                                               autocomplete="name" 
                                               autofocus
                                               placeholder="Enter your full name">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Email Address -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-medium d-flex align-items-center">
                                        <i class="fas fa-envelope me-2 text-primary"></i>
                                        Email Address
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input id="email" type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               required 
                                               autocomplete="email"
                                               placeholder="Enter your email address">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-medium d-flex align-items-center">
                                        <i class="fas fa-lock me-2 text-primary"></i>
                                        Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input id="password" type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               name="password" 
                                               required 
                                               autocomplete="new-password"
                                               placeholder="Create a secure password">
                                        <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Must be at least 8 characters with letters and numbers
                                    </small>
                                </div>
                                
                                <!-- Confirm Password -->
                                <div class="mb-4">
                                    <label for="password-confirm" class="form-label fw-medium d-flex align-items-center">
                                        <i class="fas fa-lock me-2 text-primary"></i>
                                        Confirm Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input id="password-confirm" type="password" 
                                               class="form-control" 
                                               name="password_confirmation" 
                                               required 
                                               autocomplete="new-password"
                                               placeholder="Confirm your password">
                                        <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleConfirmPassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Terms Agreement -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                        <label class="form-check-label text-muted" for="terms">
                                            I agree to the <a href="#" class="text-primary text-decoration-none">Terms of Service</a> and <a href="#" class="text-primary text-decoration-none">Privacy Policy</a>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg fw-medium py-3">
                                        <i class="fas fa-user-plus me-2"></i>
                                        Create Account
                                    </button>
                                </div>
                                
                                {{-- <!-- Divider -->
                                <div class="position-relative my-4">
                                    <hr>
                                    <div class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted">
                                        or continue with
                                    </div>
                                </div>
                                
                                <!-- Social Login -->
                                <div class="row g-2 mb-4">
                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-outline-secondary w-100">
                                            <i class="fab fa-google me-2"></i>Google
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-outline-secondary w-100">
                                            <i class="fab fa-linkedin me-2"></i>LinkedIn
                                        </a>
                                    </div>
                                </div> --}}
                                
                                <!-- Login Link -->
                                <div class="text-center">
                                    <p class="text-muted mb-0">
                                        Already have an account?
                                        <a href="{{ route('login') }}" class="text-primary fw-medium text-decoration-none">
                                            Sign in here
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }
    
    .min-vh-80 {
        min-height: 80vh;
    }
    
    .feature-check {
        width: 24px;
        height: 24px;
        background: white;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 0.75rem;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.1);
    }
    
    .input-group-text {
        background-color: var(--gray-100);
        border-color: var(--gray-300);
        transition: all 0.2s ease;
    }
    
    .input-group:focus-within .input-group-text {
        border-color: var(--primary-color);
        background-color: white;
    }
    
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-outline-secondary {
        border-color: var(--gray-300);
        color: var(--gray-600);
        transition: all 0.2s ease;
    }
    
    .btn-outline-secondary:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background-color: rgba(99, 102, 241, 0.05);
    }
    
    .alert {
        border: none;
        border-radius: var(--border-radius-md);
    }
    
    .alert ul {
        padding-left: 1rem;
    }
    
    .alert ul li {
        margin-bottom: 0.25rem;
    }
    
    /* Animation for form */
    .card {
        animation: slideUp 0.5s ease-out;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password-confirm');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
        
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
        
        // Form validation enhancement
        const form = document.querySelector('form');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const termsCheckbox = document.getElementById('terms');
        
        // Real-time validation
        nameInput.addEventListener('blur', function() {
            if (this.value.trim().length < 2) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
        
        emailInput.addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.value)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
        
        passwordInput.addEventListener('input', function() {
            // Remove invalid class as user types
            if (this.value.length >= 8) {
                this.classList.remove('is-invalid');
            }
        });
        
        confirmPasswordInput.addEventListener('input', function() {
            if (this.value === passwordInput.value && this.value.length > 0) {
                this.classList.remove('is-invalid');
            }
        });
        
        // Form submission validation
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Check if passwords match
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.classList.add('is-invalid');
                isValid = false;
            }
            
            // Check terms agreement
            if (!termsCheckbox.checked) {
                termsCheckbox.classList.add('is-invalid');
                const termsError = document.createElement('div');
                termsError.className = 'invalid-feedback d-block';
                termsError.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>You must agree to the terms and conditions';
                
                const termsContainer = termsCheckbox.closest('.form-check');
                if (!termsContainer.querySelector('.invalid-feedback')) {
                    termsContainer.appendChild(termsError);
                }
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = form.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
        
        // Remove error when terms is checked
        termsCheckbox.addEventListener('change', function() {
            if (this.checked) {
                this.classList.remove('is-invalid');
                const errorMessage = this.closest('.form-check').querySelector('.invalid-feedback');
                if (errorMessage) {
                    errorMessage.remove();
                }
            }
        });
    });
</script>
@endsection