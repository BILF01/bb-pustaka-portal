<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $category=$request->query('category');

        $newsList=News::with('category')
            ->published()
            ->when($request->filled('q'),fn($q)=>$q->where('title','like','%'.$request->query('q').'%'))
            ->when($category,fn($q)=>$q->whereHas('category',fn($c)=>$c->where('slug',$category)))
            ->latestFirst()
            ->paginate(9)
            ->withQueryString();

        $categories=NewsCategory::query()->orderBy('name')->get();

        return view('pages.news.index',compact('newsList','categories'));
    }

    public function show(News $news): View
    {
        $previousNews=News::published()->where('published_at','<',$news->published_at)->latestFirst()->first();
        $nextNews=News::published()->where('published_at','>',$news->published_at)->orderBy('published_at')->first();

        return view('pages.news.show',compact('news','previousNews','nextNews'));
    }
}