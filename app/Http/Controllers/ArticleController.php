<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $articles = $query->paginate(9)->withQueryString();
        $schoolInfo = \App\Models\SchoolInformation::first();

        // Get categories for filter dropdown
        $categories = Article::select('category')->distinct()->pluck('category');

        return view('articles.index', compact('articles', 'schoolInfo', 'categories'));
    }

    /**
     * Display the specified article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\View\View
     */
    public function show(Article $article)
    {
        // Ensure only published articles can be viewed directly if needed,
        // although the landing page only links to published ones.
        if ($article->status !== 'published') {
            abort(404);
        }

        // Get related articles (excluding current one)
        $relatedArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->latest()
            ->take(3)
            ->get();

        // If not enough related articles by category, fill with latest published
        if ($relatedArticles->count() < 3) {
            $moreArticles = Article::where('status', 'published')
                ->where('id', '!=', $article->id)
                ->whereNotIn('id', $relatedArticles->pluck('id'))
                ->latest()
                ->take(3 - $relatedArticles->count())
                ->get();

            $relatedArticles = $relatedArticles->concat($moreArticles);
        }

        $schoolInfo = \App\Models\SchoolInformation::first();

        return view('articles.show', compact('article', 'relatedArticles', 'schoolInfo'));
    }
}
