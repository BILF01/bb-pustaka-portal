<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\FooterLink;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.bb-pustaka');

        View::composer('components.footer', function ($view): void {
            $view->with([
                'quickLinks' => FooterLink::group('quick_links')->get(),
                'informationLinks' => FooterLink::group('information')->get(),
                'socialLinks' => FooterLink::group('social')->get(),
            ]);
        });
    }
}