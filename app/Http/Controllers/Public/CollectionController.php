<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function index(Request $request): View
    {
        $collections = Collection::with('category')
            ->search($request->query('q'))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('pages.collections.index', compact('collections'));
    }

    public function show(Collection $collection): View
    {
        return view('pages.collections.show', compact('collection'));
    }
}