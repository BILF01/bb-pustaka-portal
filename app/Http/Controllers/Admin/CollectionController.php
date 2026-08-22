<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use App\Models\Collection;
use App\Models\CollectionCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function index(Request $request): View
    {
        $query = Collection::query()
            ->with('category')
            ->latest();

        if ($request->filled('q')) {
            $query->search(trim((string) $request->query('q')));
        }

        if ($request->filled('category')) {
            $query->where('collection_category_id', $request->query('category'));
        }

        if ($request->query('featured') === 'yes') {
            $query->where('is_featured', true);
        }

        if ($request->query('featured') === 'no') {
            $query->where('is_featured', false);
        }

        $collections = $query
            ->paginate(15)
            ->withQueryString();

        $categories = CollectionCategory::query()
            ->orderBy('name')
            ->get();

        return view('admin.collections.index', compact('collections', 'categories'));
    }

    public function create(): View
    {
        $categories = CollectionCategory::query()->orderBy('name')->get();

        return view('admin.collections.create', compact('categories'));
    }

    public function store(StoreCollectionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title']).'-'.Str::random(6);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('cover')) {
            $validated['cover_path'] = Storage::disk('public')->url(
                $request->file('cover')->store('collections', 'public')
            );
        }

        Collection::create($validated);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Koleksi berhasil ditambahkan.');
    }

    public function edit(Collection $collection): View
    {
        $categories = CollectionCategory::query()->orderBy('name')->get();

        return view('admin.collections.edit', compact('collection', 'categories'));
    }

    public function update(UpdateCollectionRequest $request, Collection $collection): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('cover')) {
            $validated['cover_path'] = Storage::disk('public')->url(
                $request->file('cover')->store('collections', 'public')
            );
        }

        $collection->update($validated);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Koleksi berhasil diperbarui.');
    }

    public function destroy(Collection $collection): RedirectResponse
    {
        $collection->delete();

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Koleksi berhasil dihapus.');
    }
}