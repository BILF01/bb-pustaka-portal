<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocaleController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        if (! in_array($locale, ['id', 'en'], true)) {
            $locale = 'id';
        }

        session(['locale' => $locale]);

        return back();
    }
}