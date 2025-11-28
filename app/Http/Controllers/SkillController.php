<?php
// app/Http/Controllers/SkillController.php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(Portfolio $portfolio)
    {
        $this->authorize('view', $portfolio);
        $skills = $portfolio->skills;
        return view('portfolios.sections.skills.index', compact('portfolio', 'skills'));
    }

    public function create(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        return view('portfolios.sections.skills.create', compact('portfolio'));
    }

    public function store(Request $request, Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced,expert',
        ]);

        $portfolio->skills()->create($request->all());

        return redirect()->route('portfolios.show', $portfolio)->with('success', 'Skill added successfully!');
    }

    public function edit(Skill $skill)
    {
        $this->authorize('update', $skill->portfolio);
        return view('portfolios.sections.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $this->authorize('update', $skill->portfolio);
        
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced,expert',
        ]);

        $skill->update($request->all());

        return redirect()->route('portfolios.show', $skill->portfolio)->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill)
    {
        $this->authorize('update', $skill->portfolio);
        $skill->delete();

        return redirect()->route('portfolios.show', $skill->portfolio)->with('success', 'Skill deleted successfully!');
    }
}