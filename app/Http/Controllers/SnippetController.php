<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SnippetController extends Controller
{
    public function index(Request $request)
    {
        $query = Snippet::query();

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $snippets = $query->latest()->get();
        $languages = Snippet::select('language')->distinct()->pluck('language');

        return Inertia::render('Snippets/Index', [
            'snippets' => $snippets,
            'languages' => $languages,
            'filters' => $request->only(['language', 'search']),
        ]);
    }

    public function show(Snippet $snippet)
    {
        $relatedSnippets = Snippet::where('language', $snippet->language)
            ->where('id', '!=', $snippet->id)
            ->take(3)
            ->get();

        return Inertia::render('Snippets/Show', [
            'snippet' => $snippet,
            'relatedSnippets' => $relatedSnippets,
        ]);
    }
}
