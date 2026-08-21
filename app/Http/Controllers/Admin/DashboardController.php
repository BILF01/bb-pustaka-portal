<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Collection;
use App\Models\ContactMessage;
use App\Models\Feedback;
use App\Models\HeroSlide;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $stats = [];

        if ($user->can('news.manage')) {
            $stats['news'] = News::query()->count();
            $stats['news_published'] = News::query()->where('is_published', true)->count();
        }

        if ($user->can('hero-slides.manage')) {
            $stats['hero_slides'] = HeroSlide::query()->count();
        }

        if ($user->can('collections.manage')) {
            $stats['collections'] = Collection::query()->count();
            $stats['collections_featured'] = Collection::query()->where('is_featured', true)->count();
        }

        if ($user->can('agendas.manage')) {
            $now = now();

            $stats['agendas'] = Agenda::query()->count();

            $stats['agendas_upcoming'] = Agenda::query()
                ->where('starts_at', '>', $now)
                ->count();

            $stats['agendas_ongoing'] = Agenda::query()
                ->where('starts_at', '<=', $now)
                ->whereNotNull('ends_at')
                ->where('ends_at', '>=', $now)
                ->count();

            $stats['agendas_completed'] = Agenda::query()
                ->where(function ($query) use ($now): void {
                    $query
                        ->where(function ($query) use ($now): void {
                            $query
                                ->whereNotNull('ends_at')
                                ->where('ends_at', '<', $now);
                        })
                        ->orWhere(function ($query) use ($now): void {
                            $query
                                ->whereNull('ends_at')
                                ->where('starts_at', '<', $now);
                        });
                })
                ->count();
        }

        if ($user->can('feedback.view')) {
            $stats['feedback'] = Feedback::query()->count();
        }

        if ($user->can('contact-messages.manage')) {
            $stats['contact_messages'] = ContactMessage::query()->count();
            $stats['contact_messages_unread'] = ContactMessage::query()
                ->where('is_read', false)
                ->count();
        }

        return view('admin.dashboard', compact('stats'));
    }
}