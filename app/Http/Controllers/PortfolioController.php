<?php
// app/Http/Controllers/PortfolioController.php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('user_id', auth()->id())->latest()->get();
        return view('portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('portfolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:cv,resume,portfolio',
            'template_name' => 'required|string|max:255',
        ]);

        Portfolio::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'type' => $request->type,
            'template_name' => $request->template_name,
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio created successfully!');
    }

    public function show(Portfolio $portfolio)
    {
        $this->authorize('view', $portfolio);
        
        return view('portfolios.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        return view('portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:cv,resume,portfolio',
            'template_name' => 'required|string|max:255',
        ]);

        $portfolio->update($request->all());

        return redirect()->route('portfolios.index')->with('success', 'Portfolio updated successfully!');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->authorize('delete', $portfolio);
        
        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('success', 'Portfolio deleted successfully!');
    }
}