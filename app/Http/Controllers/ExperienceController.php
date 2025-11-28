<?php
// app/Http/Controllers/ExperienceController.php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(Portfolio $portfolio)
    {
        $this->authorize('view', $portfolio);
        
        $experiences = $portfolio->experiences;
        return view('portfolios.sections.experiences.index', compact('portfolio', 'experiences'));
    }

    public function create(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        return view('portfolios.sections.experiences.create', compact('portfolio'));
    }

    public function store(Request $request, Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'description' => 'nullable|string',
        ]);

        $portfolio->experiences()->create($request->all());

        return redirect()->route('portfolios.show', $portfolio)->with('success', 'Experience added successfully!');
    }

    public function edit(Experience $experience)
    {
        $this->authorize('update', $experience->portfolio);
        
        return view('portfolios.sections.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $this->authorize('update', $experience->portfolio);
        
        $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'description' => 'nullable|string',
        ]);

        $experience->update($request->all());

        return redirect()->route('portfolios.show', $experience->portfolio)->with('success', 'Experience updated successfully!');
    }

    public function destroy(Experience $experience)
    {
        $this->authorize('update', $experience->portfolio);
        
        $experience->delete();

        return redirect()->route('portfolios.show', $experience->portfolio)->with('success', 'Experience deleted successfully!');
    }
}