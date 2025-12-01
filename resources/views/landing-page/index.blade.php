<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            overflow-x: hidden;
            background-color: var(--light-color);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            line-height: 1.2;
        }
        
        /* Modern Navbar */
        .navbar {
            padding: 1.5rem 0;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .navbar.scrolled {
            padding: 1rem 0;
            box-shadow: var(--shadow-md);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            margin: 0 0.25rem;
            border-radius: var(--border-radius-sm);
            transition: all 0.2s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
            background-color: var(--gray-100);
        }
        
        /* Modern Hero Section */
        .hero-section {
            padding: 10rem 0 6rem;
            background: linear-gradient(135deg, #f6f7ff 0%, #f0f4ff 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--gray-600);
            margin-bottom: 2rem;
            max-width: 600px;
        }
        
        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: block;
            line-height: 1;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: var(--gray-600);
            font-weight: 500;
        }
        
        /* Modern Buttons */
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 0.875rem 2rem;
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
            padding: 0.875rem 2rem;
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
        
        /* Sections */
        .section {
            padding: 6rem 0;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .section-subtitle {
            font-size: 1.125rem;
            color: var(--gray-600);
            text-align: center;
            max-width: 600px;
            margin: 0 auto 3rem;
        }
        
        /* Feature Cards - Granola.ai inspired */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .feature-card {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 2rem;
            transition: all 0.3s ease;
            border: 1px solid var(--gray-200);
            position: relative;
            overflow: hidden;
            height: 100%;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-color);
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: var(--border-radius-md);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        .feature-card h4 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }
        
        .feature-card p {
            color: var(--gray-600);
            margin-bottom: 1.5rem;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            color: var(--gray-600);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .feature-list li i {
            color: var(--primary-color);
            margin-right: 0.75rem;
            font-size: 0.875rem;
        }
        
        /* How It Works - Modern Steps */
        .steps-container {
            position: relative;
            padding: 3rem 0;
        }
        
        .step-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gradient-primary);
            transform: translateY(-50%);
            z-index: 1;
        }
        
        .step {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 2rem;
        }
        
        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: white;
            border: 3px solid var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary-color);
            margin: 0 auto 1.5rem;
            position: relative;
        }
        
        .step-content {
            background: white;
            padding: 1.5rem;
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-md);
        }
        
        /* Testimonials - Modern Cards */
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .testimonial-card {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }
        
        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }
        
        .testimonial-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
            border: 3px solid var(--primary-color);
        }
        
        .testimonial-rating {
            color: #fbbf24;
            margin-bottom: 0.5rem;
        }
        
        .testimonial-text {
            color: var(--gray-600);
            font-style: italic;
            margin-bottom: 1.5rem;
        }
        
        /* CTA Section */
        .cta-section {
            background: var(--gradient-dark);
            color: white;
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 30%, rgba(99, 102, 241, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 70%, rgba(139, 92, 246, 0.2) 0%, transparent 50%);
        }
        
        .cta-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .cta-subtitle {
            font-size: 1.125rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 4rem 0 2rem;
        }
        
        .footer h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        
        .footer-links a {
            color: var(--gray-300);
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .newsletter-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius-sm);
            width: 100%;
        }
        
        .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 3rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section {
                padding: 4rem 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .step-line {
                display: none;
            }
        }
        
        /* Animations */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .floating {
            animation: float 5s ease-in-out infinite;
        }
        
        /* Custom Utilities */
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
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-step-forward"></i> NextStep
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    
                    @auth
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-outline" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item ms-2">
                            <a class="btn btn-outline" href="{{ route('login') }}">
                                Sign In
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary" href="{{ route('register') }}">
                                Get Started
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Your Gateway to the Next Step of Your Career</h1>
                    <p class="hero-subtitle">Create professional portfolios, learn new skills, and get career guidance - all in one platform designed to help you succeed.</p>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="fas fa-rocket me-2"></i> Start Free Trial
                        </a>
                        <a href="#features" class="btn btn-outline">
                            <i class="fas fa-play-circle me-2"></i> See How It Works
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Happy Users</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">1K+</span>
                            <span class="stat-label">Portfolios Created</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">100+</span>
                            <span class="stat-label">Career Courses</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="position-relative floating">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary rounded-3" style="transform: rotate(3deg); opacity: 0.1;"></div>
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                             class="img-fluid rounded-3 shadow-2xl position-relative" alt="Career Success">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Everything You Need for Career Success</h2>
                <p class="section-subtitle">Powerful tools designed to help you build, learn, and grow</p>
            </div>
            
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4>Portfolio Builder</h4>
                    <p>Create stunning resumes, CVs, and portfolios with our easy-to-use builder and professional templates.</p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Multiple templates</li>
                        <li><i class="fas fa-check"></i> Easy customization</li>
                        <li><i class="fas fa-check"></i> One-click export</li>
                    </ul>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>Career Academy</h4>
                    <p>Access curated courses and tutorials to develop skills that employers are looking for.</p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Expert-led courses</li>
                        <li><i class="fas fa-check"></i> Free & paid options</li>
                        <li><i class="fas fa-check"></i> Progress tracking</li>
                    </ul>
                </div>
{{--                 
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h4>Career Guide</h4>
                    <p>Get expert advice, interview tips, and industry insights from our comprehensive career resources.</p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Latest articles</li>
                        <li><i class="fas fa-check"></i> Industry trends</li>
                        <li><i class="fas fa-check"></i> Success stories</li>
                    </ul>
                </div> --}}
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h4>AI Career Assistant</h4>
                    <p>Get instant career guidance, resume reviews, and interview preparation from our AI assistant.</p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> 24/7 availability</li>
                        <li><i class="fas fa-check"></i> Personalized tips</li>
                        <li><i class="fas fa-check"></i> Instant feedback</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="section bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">How NextStep Works</h2>
                <p class="section-subtitle">Get started in three simple steps</p>
            </div>
            
            <div class="steps-container">
                <div class="step-line d-none d-lg-block"></div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h4>Create Your Account</h4>
                                <p class="text-muted mb-0">Sign up for free and set up your profile in minutes.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h4>Build Your Portfolio</h4>
                                <p class="text-muted mb-0">Use our templates to create a professional portfolio.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h4>Launch Your Career</h4>
                                <p class="text-muted mb-0">Apply for jobs with confidence using your new portfolio.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-play me-2"></i> Start Your Journey
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Success Stories</h2>
                <p class="section-subtitle">Hear from professionals who boosted their careers with NextStep</p>
            </div>
            
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                             class="testimonial-avatar" alt="Sarah">
                        <div>
                            <h5 class="mb-0">Sarah Johnson</h5>
                            <small class="text-muted">Software Developer</small>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">"NextStep helped me create a portfolio that got me 3 job offers in 2 weeks. The AI resume review was incredibly helpful!"</p>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                             class="testimonial-avatar" alt="Michael">
                        <div>
                            <h5 class="mb-0">Michael Chen</h5>
                            <small class="text-muted">Marketing Manager</small>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">"The career courses on NextStep helped me transition from marketing assistant to manager in under a year."</p>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                             class="testimonial-avatar" alt="Jessica">
                        <div>
                            <h5 class="mb-0">Jessica Williams</h5>
                            <small class="text-muted">Graphic Designer</small>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">"As a freelancer, having a professional portfolio was crucial. NextStep made it easy to showcase my work beautifully."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="cta-title">Ready to Take the Next Step?</h2>
                    <p class="cta-subtitle">Join thousands of professionals who have transformed their careers with NextStep.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5">
                        <i class="fas fa-rocket me-2"></i> Start Free Today
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4 class="mb-4">
                        <i class="fas fa-step-forward me-2"></i> NextStep
                    </h4>
                    <p class="text-light mb-4">Your gateway to the next step of your career. Build portfolios, learn skills, and get career guidance.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5 class="mb-4">Features</h5>
                    <ul class="footer-links">
                        <li><a href="#features">Portfolio Builder</a></li>
                        <li><a href="#features">Career Academy</a></li>
                        <li><a href="#features">Career Guide</a></li>
                        <li><a href="#features">AI Assistant</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5 class="mb-4">Company</h5>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4">
                    <h5 class="mb-4">Stay Updated</h5>
                    <p class="text-light mb-3">Subscribe to our newsletter for career tips and updates.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control newsletter-input" placeholder="Your email address">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; 2024 NextStep. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="text-light me-3">Privacy Policy</a>
                        <a href="#" class="text-light">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation class to feature cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, observerOptions);
            
            // Observe feature cards
            document.querySelectorAll('.feature-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>