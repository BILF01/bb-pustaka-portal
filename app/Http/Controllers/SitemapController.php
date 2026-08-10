<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\News;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(ResponseFactory $response): Response
    {
        $news = News::published()->get(['slug', 'updated_at']);
        $collections = Collection::query()->get(['slug', 'updated_at']);

        $xml = view('sitemap', compact('news', 'collections'))->render();

        return $response->make($xml, 200, ['Content-Type' => 'application/xml']);
    }
}