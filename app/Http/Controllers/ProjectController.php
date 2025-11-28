<?php
// app/Http/Controllers/ProjectController.php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Portfolio $portfolio)
    {
        $this->authorize('view', $portfolio);
        $projects = $portfolio->projects;
        return view('portfolios.sections.projects.index', compact('portfolio', 'projects'));
    }

    public function create(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        return view('portfolios.sections.projects.create', compact('portfolio'));
    }

    public function store(Request $request, Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'nullable|url',
        ]);

        $portfolio->projects()->create($request->all());

        return redirect()->route('portfolios.show', $portfolio)->with('success', 'Project added successfully!');
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project->portfolio);
        return view('portfolios.sections.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project->portfolio);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'nullable|url',
        ]);

        $project->update($request->all());

        return redirect()->route('portfolios.show', $project->portfolio)->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $project->portfolio);
        $project->delete();

        return redirect()->route('portfolios.show', $project->portfolio)->with('success', 'Project deleted successfully!');
    }
}