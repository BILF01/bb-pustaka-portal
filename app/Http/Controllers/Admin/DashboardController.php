<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\News;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'news' => News::query()->count(),
            'news_published' => News::query()->where('is_published', true)->count(),
            'collections' => Collection::query()->count(),
            'collections_featured' => Collection::query()->where('is_featured', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}