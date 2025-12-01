<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NextStep - Your Career Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #8b5cf6;
            --accent-color: #06b6d4;
            --dark-color: #0f172a;
            --light-color: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-600: #475569;
            --gray-800: #1e293b;
            
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --gradient-accent: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
            
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0,0,0,0.25);
            
            --border-radius-sm: 8px;
            --border-radius-md: 12px;
            --border-radius-lg: 20px;
            --border-radius-xl: 30px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--gray-800);
            line-height: 1.6;
            background-color: var(--light-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            line-height: 1.2;
        }
        
        /* Modern Navbar */
        .navbar {
            padding: 1rem 0;
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: translateY(-1px);
        }
        
        .navbar-brand i {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--gray-600);
            padding: 0.5rem 1rem;
            margin: 0 0.125rem;
            border-radius: var(--border-radius-sm);
            transition: all 0.2s ease;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
            background-color: var(--gray-100);
        }
        
        .nav-link.active {
            color: var(--primary-color);
            background-color: rgba(99, 102, 241, 0.1);
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 50%;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-lg);
            border-radius: var(--border-radius-md);
            border: 1px solid var(--gray-200);
            margin-top: 0.5rem;
        }
        
        .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius-sm);
            margin: 0.125rem;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: var(--gray-100);
            color: var(--primary-color);
        }
        
        .dropdown-divider {
            margin: 0.5rem 0.75rem;
            border-color: var(--gray-200);
        }
        
        /* Modern Buttons */
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        /* Card Styles */
        .card {
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-lg);
            background: white;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-color);
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 1.5rem;
            font-weight: 600;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-footer {
            background: var(--gray-100);
            border-top: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
        }
        
        /* Main Content */
        main {
            flex: 1;
            padding: 2rem 0;
        }
        
        /* Page Header */
        .page-header {
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
        }
        
        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }
        
        .page-header .lead {
            color: var(--gray-600);
            font-size: 1.125rem;
        }
        
        /* Dashboard Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        
        .stat-card {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--border-radius-md);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: var(--primary-color);
            font-size: 1.25rem;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            color: var(--gray-600);
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        /* Form Elements */
        .form-control, .form-select {
            border: 1px solid var(--gray-300);
            border-radius: var(--border-radius-md);
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }
        
        /* Badges */
        .badge {
            padding: 0.35rem 0.75rem;
            font-weight: 500;
            border-radius: var(--border-radius-sm);
        }
        
        .badge-primary {
            background: var(--gradient-primary);
            color: white;
        }
        
        .badge-success {
            background: var(--gradient-accent);
            color: white;
        }
        
        /* Tables */
        .table {
            background: white;
            border-radius: var(--border-radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }
        
        .table thead th {
            background: var(--gray-100);
            border-bottom: 2px solid var(--gray-200);
            font-weight: 600;
            color: var(--gray-800);
            padding: 1rem;
        }
        
        .table tbody td {
            padding: 1rem;
            border-color: var(--gray-200);
            vertical-align: middle;
        }
        
        .table tbody tr:hover {
            background-color: var(--gray-100);
        }
        
        /* Alert Styles */
        .alert {
            border: none;
            border-radius: var(--border-radius-md);
            padding: 1rem 1.5rem;
            box-shadow: var(--shadow-sm);
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%);
            border-left: 4px solid #10b981;
            color: #065f46;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
            border-left: 4px solid #ef4444;
            color: #7f1d1d;
        }
        
        /* Footer */
        .app-footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
            margin-top: auto;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer-content p {
            margin: 0;
            color: var(--gray-300);
        }
        
        .footer-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .footer-links a {
            color: var(--gray-300);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        /* Empty States */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--gray-600);
        }
        
        .empty-state-icon {
            font-size: 3rem;
            color: var(--gray-300);
            margin-bottom: 1rem;
        }
        
        .empty-state h3 {
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }
        
        /* Loading States */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            main {
                padding: 1rem 0;
            }
            
            .page-header h1 {
                font-size: 1.75rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
        
        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Utility Classes */
        .gradient-text {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .shadow-hover {
            transition: box-shadow 0.3s ease;
        }
        
        .shadow-hover:hover {
            box-shadow: var(--shadow-lg);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light" style="z-index: 1000000">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    <i class="fas fa-step-forward"></i>NextStep
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('portfolios.*') ? 'active' : '' }}" href="{{ route('portfolios.index') }}">
                                <i class="fas fa-file-alt me-2"></i>Portfolios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                                <i class="fas fa-graduation-cap me-2"></i>Academy
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}" href="{{ route('articles.index') }}">
                                <i class="fas fa-book me-2"></i>Career Guide
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('chatbot') ? 'active' : '' }}" href="{{ route('chatbot') }}">
                                <i class="fas fa-robot me-2"></i>AI Assistant
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline me-2" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-primary" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>Register
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: var(--gradient-primary);">
                                                <span class="text-white fw-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium">{{ Auth::user()->name }}</span>
                                            <small class="text-muted">Member</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="px-3 py-2 mb-2 border-bottom">
                                        <div class="fw-medium">{{ Auth::user()->name }}</div>
                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    </div>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{ route('portfolios.index') }}">
                                        <i class="fas fa-file-alt me-2"></i>My Portfolios
                                    </a>
                                    <a class="dropdown-item" href="{{ route('bookmarks.index') }}">
                                        <i class="fas fa-bookmark me-2"></i>Bookmarks
                                    </a>
                                    {{-- <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user me-2"></i>Profile Settings
                                    </a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer class="app-footer">
            <div class="container">
                <div class="footer-content">
                    <p>&copy; {{ date('Y') }} NextStep. All rights reserved.</p>
                    <div class="footer-links">
                        <a href="">Privacy Policy</a>
                        <a href="">Terms of Service</a>
                        <a href="">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Add active state to current page in navbar
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    @stack('scripts')
</body>
</html>