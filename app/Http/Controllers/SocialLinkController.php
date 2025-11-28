<?php
// app/Http/Controllers/SocialLinkController.php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index(Portfolio $portfolio)
    {
        $this->authorize('view', $portfolio);
        $socialLinks = $portfolio->socialLinks;
        return view('portfolios.sections.socials.index', compact('portfolio', 'socialLinks'));
    }

    public function create(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        return view('portfolios.sections.socials.create', compact('portfolio'));
    }

    public function store(Request $request, Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $portfolio->socialLinks()->create($request->all());

        return redirect()->route('portfolios.show', $portfolio)->with('success', 'Social link added successfully!');
    }

    public function edit(SocialLink $socialLink)
    {
        $this->authorize('update', $socialLink->portfolio);
        return view('portfolios.sections.socials.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $this->authorize('update', $socialLink->portfolio);
        
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $socialLink->update($request->all());

        return redirect()->route('portfolios.show', $socialLink->portfolio)->with('success', 'Social link updated successfully!');
    }

    public function destroy(SocialLink $socialLink)
    {
        $this->authorize('update', $socialLink->portfolio);
        $socialLink->delete();

        return redirect()->route('portfolios.show', $socialLink->portfolio)->with('success', 'Social link deleted successfully!');
    }
}