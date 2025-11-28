<?php
// app/Http/Controllers/ArticleController.php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }
        
        $articles = $query->latest()->paginate(9);
        
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->latest()
            ->limit(3)
            ->get();
            
        return view('articles.show', compact('article', 'relatedArticles'));
    }
}