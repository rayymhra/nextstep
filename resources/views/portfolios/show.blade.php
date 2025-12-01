{{-- resources/views/portfolios/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>{{ $portfolio->title }}</h1>
                    <p class="text-muted mb-0">
                        <span class="badge bg-secondary">{{ ucfirst($portfolio->type) }}</span>
                        <span class="badge bg-light text-dark">{{ $portfolio->template_name }} Template</span>
                    </p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('portfolios.edit', $portfolio) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-edit"></i> Edit Portfolio
                    </a>
                    <a href="{{ route('portfolios.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        {{-- Navigation Sidebar --}}
        <div class="col-md-3">
            <div class="card sticky-top" style="top: 100px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Portfolio Sections</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#basic-info" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i>Basic Information
                    </a>
                    <a href="#experiences" class="list-group-item list-group-item-action">
                        <i class="fas fa-briefcase me-2"></i>Work Experience
                        <span class="badge bg-primary rounded-pill float-end">{{ $portfolio->experiences->count() }}</span>
                    </a>
                    <a href="#education" class="list-group-item list-group-item-action">
                        <i class="fas fa-graduation-cap me-2"></i>Education
                        <span class="badge bg-primary rounded-pill float-end">{{ $portfolio->educations->count() }}</span>
                    </a>
                    <a href="#skills" class="list-group-item list-group-item-action">
                        <i class="fas fa-tools me-2"></i>Skills
                        <span class="badge bg-primary rounded-pill float-end">{{ $portfolio->skills->count() }}</span>
                    </a>
                    <a href="#projects" class="list-group-item list-group-item-action">
                        <i class="fas fa-project-diagram me-2"></i>Projects
                        <span class="badge bg-primary rounded-pill float-end">{{ $portfolio->projects->count() }}</span>
                    </a>
                    <a href="#social" class="list-group-item list-group-item-action">
                        <i class="fas fa-share-alt me-2"></i>Social Links
                        <span class="badge bg-primary rounded-pill float-end">{{ $portfolio->socialLinks->count() }}</span>
                    </a>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print/Export
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Portfolio Content --}}
        <div class="col-md-9">
            {{-- Basic Info --}}
            <div class="card mb-4" id="basic-info">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Basic Information</h5>
                    <span class="badge bg-secondary">{{ ucfirst($portfolio->type) }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>{{ auth()->user()->name }}</h4>
                            <p class="text-muted">Professional {{ ucfirst($portfolio->type) }}</p>
                            <p class="mb-0">
                                <strong>Template:</strong> {{ $portfolio->template_name }}<br>
                                <strong>Created:</strong> {{ $portfolio->created_at->format('M d, Y') }}<br>
                                <strong>Last Updated:</strong> {{ $portfolio->updated_at->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="mt-3 mt-md-0">
                                <span class="badge bg-primary fs-6">{{ $portfolio->template_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Work Experience --}}
            <div class="card mb-4" id="experiences">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Work Experience</h5>
                    <a href="{{ route('portfolios.experiences.create', $portfolio) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Experience
                    </a>
                </div>
                <div class="card-body">
                    @if($portfolio->experiences->count() > 0)
                        @foreach($portfolio->experiences as $experience)
                            <div class="experience-item mb-4 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $experience->position }}</h6>
                                        <p class="mb-1 text-primary">
                                            <i class="fas fa-building me-1"></i>{{ $experience->company }}
                                        </p>
                                        <p class="mb-2 text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $experience->start_date->format('M Y') }} - 
                                            {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}
                                            • {{ $experience->end_date ? $experience->start_date->diffInMonths($experience->end_date) : $experience->start_date->diffInMonths(now()) }} months
                                        </p>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('experiences.edit', $experience) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('experiences.destroy', $experience) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this experience?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @if($experience->description)
                                    <p class="mb-0 text-muted">{{ $experience->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No work experience added yet.</p>
                            <a href="{{ route('portfolios.experiences.create', $portfolio) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Your First Experience
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Education Section --}}
            <div class="card mb-4" id="education">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Education</h5>
                    <a href="{{ route('portfolios.educations.create', $portfolio) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Education
                    </a>
                </div>
                <div class="card-body">
                    @if($portfolio->educations->count() > 0)
                        @foreach($portfolio->educations as $education)
                            <div class="education-item mb-4 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $education->degree }}</h6>
                                        <p class="mb-1 text-primary">
                                            <i class="fas fa-university me-1"></i>{{ $education->school }}
                                        </p>
                                        <p class="mb-2 text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $education->start_year }} - {{ $education->end_year ?? 'Present' }}
                                            @if($education->end_year)
                                                • {{ $education->end_year - $education->start_year }} years
                                            @endif
                                        </p>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('educations.edit', $education) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('educations.destroy', $education) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this education?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @if($education->description)
                                    <p class="mb-0 text-muted">{{ $education->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No education added yet.</p>
                            <a href="{{ route('portfolios.educations.create', $portfolio) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Your First Education
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Skills Section --}}
            <div class="card mb-4" id="skills">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Skills</h5>
                    <a href="{{ route('portfolios.skills.create', $portfolio) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Skill
                    </a>
                </div>
                <div class="card-body">
                    @if($portfolio->skills->count() > 0)
                        <div class="row">
                            @foreach($portfolio->skills as $skill)
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-3 border rounded">
                                        <div>
                                            <span class="fw-medium">{{ $skill->skill_name }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-{{ $skill->level == 'expert' ? 'success' : ($skill->level == 'advanced' ? 'primary' : ($skill->level == 'intermediate' ? 'warning' : 'secondary')) }} me-2">
                                                {{ ucfirst($skill->level) }}
                                            </span>
                                            <div class="btn-group">
                                                <a href="{{ route('skills.edit', $skill) }}" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('skills.destroy', $skill) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this skill?')">
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
                        <div class="text-center py-4">
                            <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No skills added yet.</p>
                            <a href="{{ route('portfolios.skills.create', $portfolio) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Your First Skill
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Projects Section --}}
            <div class="card mb-4" id="projects">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Projects</h5>
                    <a href="{{ route('portfolios.projects.create', $portfolio) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Project
                    </a>
                </div>
                <div class="card-body">
                    @if($portfolio->projects->count() > 0)
                        <div class="row">
                            @foreach($portfolio->projects as $project)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 project-card">
                                        @if($project->image)
                                            <img src="{{ $project->image }}" class="card-img-top" alt="{{ $project->title }}" style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                <i class="fas fa-project-diagram fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold">{{ $project->title }}</h6>
                                            <p class="card-text text-muted small">{{ Str::limit($project->description, 100) }}</p>
                                        </div>
                                        <div class="card-footer bg-transparent">
                                            <div class="btn-group w-100">
                                                @if($project->link)
                                                    <a href="{{ $project->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-external-link-alt"></i> View
                                                    </a>
                                                @endif
                                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this project?')">
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
                        <div class="text-center py-4">
                            <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No projects added yet.</p>
                            <a href="{{ route('portfolios.projects.create', $portfolio) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Your First Project
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Social Links Section --}}
            <div class="card mb-4" id="social">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Social Links</h5>
                    <a href="{{ route('portfolios.socials.create', $portfolio) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Social Link
                    </a>
                </div>
                <div class="card-body">
                    @if($portfolio->socialLinks->count() > 0)
                        <div class="row">
                            @foreach($portfolio->socialLinks as $social)
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-3 border rounded">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-{{ $social->platform }} fa-2x text-{{ $social->platform }} me-3"></i>
                                            <div>
                                                <span class="text-capitalize fw-medium d-block">{{ $social->platform }}</span>
                                                <small class="text-muted">{{ Str::limit($social->url, 30) }}</small>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <a href="{{ $social->url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <a href="{{ route('socials.edit', $social) }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('socials.destroy', $social) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this social link?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-share-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No social links added yet.</p>
                            <a href="{{ route('portfolios.socials.create', $portfolio) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Your First Social Link
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.project-card {
    transition: transform 0.2s;
}
.project-card:hover {
    transform: translateY(-5px);
}
.sticky-top {
    position: sticky;
    z-index: 100;
}
.experience-item:last-child,
.education-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}
</style>

<script>
// Smooth scroll for navigation
document.querySelectorAll('.list-group-item').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
</script>
@endsection