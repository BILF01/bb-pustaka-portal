<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $query = News::query()
            ->with('category')
            ->latest();

        if ($request->filled('q')) {
            $search = trim((string) $request->query('q'));

            $query->where(function ($query) use ($search): void {
                $query
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('news_category_id', $request->query('category'));
        }

        if ($request->query('status') === 'published') {
            $query->where('is_published', true);
        }

        if ($request->query('status') === 'draft') {
            $query->where('is_published', false);
        }

        $newsList = $query
            ->paginate(15)
            ->withQueryString();

        $categories = NewsCategory::query()
            ->orderBy('name')
            ->get();

        return view('admin.news.index', compact('newsList', 'categories'));
    }

    public function create(): View
    {
        $categories = NewsCategory::query()->orderBy('name')->get();

        return view('admin.news.create', compact('categories'));
    }

    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title']).'-'.Str::random(6);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        if ($request->hasFile('image')) {
            $validated['image_path'] = Storage::disk('public')->url(
                $request->file('image')->store('news', 'public')
            );
        }

        News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $news): View
    {
        $categories = NewsCategory::query()->orderBy('name')->get();

        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(UpdateNewsRequest $request, News $news): RedirectResponse
    {
        $validated = $request->validated();

        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published']
            ? ($news->published_at ?? now())
            : null;

        if ($request->hasFile('image')) {
            $validated['image_path'] = Storage::disk('public')->url(
                $request->file('image')->store('news', 'public')
            );
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}