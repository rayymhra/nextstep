<?php
// app/Http/Controllers/EducationController.php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Portfolio $portfolio)
    {
        $this->authorize('view', $portfolio);
        $educations = $portfolio->educations;
        return view('portfolios.sections.educations.index', compact('portfolio', 'educations'));
    }

    public function create(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        return view('portfolios.sections.educations.create', compact('portfolio'));
    }

    public function store(Request $request, Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        $request->validate([
            'school' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'start_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'end_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'description' => 'nullable|string',
        ]);

        $portfolio->educations()->create($request->all());

        return redirect()->route('portfolios.show', $portfolio)->with('success', 'Education added successfully!');
    }

    public function edit(Education $education)
    {
        $this->authorize('update', $education->portfolio);
        return view('portfolios.sections.educations.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $this->authorize('update', $education->portfolio);
        
        $request->validate([
            'school' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'start_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'end_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'description' => 'nullable|string',
        ]);

        $education->update($request->all());

        return redirect()->route('portfolios.show', $education->portfolio)->with('success', 'Education updated successfully!');
    }

    public function destroy(Education $education)
    {
        $this->authorize('update', $education->portfolio);
        $education->delete();

        return redirect()->route('portfolios.show', $education->portfolio)->with('success', 'Education deleted successfully!');
    }
}