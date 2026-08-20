<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\CollectionCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function index(Request $request): View
    {
        $categories = CollectionCategory::orderBy('name')->get();

        $collections = Collection::with('category')
            ->search($request->query('q'))
            ->when($request->query('category'), fn ($query, $categorySlug) => $query->whereHas(
                'category',
                fn ($q) => $q->where('slug', $categorySlug)
            ))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('pages.collections.index', compact('collections', 'categories'));
    }

    public function show(Collection $collection): View
    {
        return view('pages.collections.show', compact('collection'));
    }

    public function suggest(Request $request): JsonResponse
    {
        $term = $request->query('q');

        if (blank($term)) {
            return response()->json([]);
        }

        $results = Collection::with('category')
            ->search($term)
            ->latest()
            ->limit(5)
            ->get()
            ->map(fn (Collection $collection): array => [
                'title' => $collection->title,
                'category' => $collection->category?->name,
                'url' => route('collections.show', $collection),
            ]);

        return response()->json($results);
    }
}