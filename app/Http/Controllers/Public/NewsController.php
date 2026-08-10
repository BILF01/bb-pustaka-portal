<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $newsList = News::with('category')
            ->published()
            ->when($request->filled('q'), fn ($q) => $q->where('title', 'like', '%'.$request->query('q').'%'))
            ->latestFirst()
            ->paginate(9)
            ->withQueryString();

        return view('pages.news.index', compact('newsList'));
    }

    public function show(News $news): View
    {
        return view('pages.news.show', compact('news'));
    }
}