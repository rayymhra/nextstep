{{-- resources/views/portfolios/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>{{ $portfolio->title }}</h1>
                <div class="btn-group">
                    <a href="{{ route('portfolios.edit', $portfolio) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-edit"></i> Edit Portfolio
                    </a>
                    <a href="{{ route('portfolios.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <p class="text-muted">
                <span class="badge bg-secondary">{{ ucfirst($portfolio->type) }}</span>
                <span class="badge bg-light text-dark">{{ $portfolio->template_name }} Template</span>
            </p>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="row">
        {{-- Navigation Sidebar --}}
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Portfolio Sections</h5>
                </div>
                <div class="list-group list-group-flush">
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
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Basic Information</h5>
                    <span class="badge bg-secondary">{{ ucfirst($portfolio->type) }}</span>
                </div>
                <div class="card-body">
                    <h4>{{ auth()->user()->name }}</h4>
                    <p class="text-muted">Created {{ $portfolio->created_at->format('M d, Y') }}</p>
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
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1">{{ $experience->position }}</h6>
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
                        <p class="mb-1 text-primary">{{ $experience->company }}</p>
                        <p class="mb-1 text-muted">
                            {{ $experience->start_date->format('M Y') }} - 
                            {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}
                        </p>
                        @if($experience->description)
                        <p class="mb-0">{{ $experience->description }}</p>
                        @endif
                    </div>
                    @endforeach
                    @else
                    <p class="text-muted text-center">No work experience added yet.</p>
                    @endif
                </div>
            </div>
            
            {{-- Add similar sections for Education, Skills, Projects, Social Links --}}
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
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1">{{ $education->degree }}</h6>
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
                        <p class="mb-1 text-primary">{{ $education->school }}</p>
                        <p class="mb-1 text-muted">
                            {{ $education->start_year }} - {{ $education->end_year ?? 'Present' }}
                        </p>
                        @if($education->description)
                        <p class="mb-0">{{ $education->description }}</p>
                        @endif
                    </div>
                    @endforeach
                    @else
                    <p class="text-muted text-center">No education added yet.</p>
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
                        <div class="col-md-6 mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $skill->skill_name }}</span>
                                <div>
                                    <span class="badge bg-{{ $skill->level == 'expert' ? 'success' : ($skill->level == 'advanced' ? 'primary' : ($skill->level == 'intermediate' ? 'warning' : 'secondary')) }}">
                                        {{ ucfirst($skill->level) }}
                                    </span>
                                    <div class="btn-group ms-2">
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
                    <p class="text-muted text-center">No skills added yet.</p>
                    @endif
                </div>
            </div>
            
            {{-- Update the remaining sections in resources/views/portfolios/show.blade.php --}}
            
            {{-- Add this after the Skills section --}}
            
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
                            <div class="card h-100">
                                @if($project->image)
                                <img src="{{ $project->image }}" class="card-img-top" alt="{{ $project->title }}" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title">{{ $project->title }}</h6>
                                    <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
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
                    <p class="text-muted text-center">No projects added yet.</p>
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
                                <div>
                                    <i class="fab fa-{{ $social->platform }} fa-2x text-{{ $social->platform }} me-3"></i>
                                    <span class="text-capitalize">{{ $social->platform }}</span>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ $social->url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt"></i> Visit
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
                    <p class="text-muted text-center">No social links added yet.</p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection