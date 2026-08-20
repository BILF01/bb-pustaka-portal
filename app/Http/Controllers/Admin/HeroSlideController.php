<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHeroSlideRequest;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    private const MAX_SLIDES = 5;

    public function index(): View
    {
        $heroSlides = HeroSlide::ordered()->get();

        return view('admin.hero-slides.index', compact('heroSlides'));
    }

    public function create(): View|RedirectResponse
    {
        if (HeroSlide::count() >= self::MAX_SLIDES) {
            return redirect()->route('admin.hero-slides.index')->with('error', 'Maksimal '.self::MAX_SLIDES.' gambar hero slider.');
        }

        return view('admin.hero-slides.create');
    }

    public function store(StoreHeroSlideRequest $request): RedirectResponse
    {
        if (HeroSlide::count() >= self::MAX_SLIDES) {
            return redirect()->route('admin.hero-slides.index')->with('error', 'Maksimal '.self::MAX_SLIDES.' gambar hero slider.');
        }

        HeroSlide::create([
            'image_path' => Storage::disk('public')->url(
                $request->file('image')->store('hero-slides', 'public')
            ),
            'order' => $request->validated('order') ?? ((HeroSlide::max('order') ?? 0) + 1),
        ]);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide hero berhasil ditambahkan.');
    }

    public function edit(HeroSlide $heroSlide): View
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(StoreHeroSlideRequest $request, HeroSlide $heroSlide): RedirectResponse
    {
        $validated = $request->validated();

        $data = ['order' => $validated['order'] ?? $heroSlide->order];

        if ($request->hasFile('image')) {
            $data['image_path'] = Storage::disk('public')->url(
                $request->file('image')->store('hero-slides', 'public')
            );
        }

        $heroSlide->update($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide hero berhasil diperbarui.');
    }

    public function destroy(HeroSlide $heroSlide): RedirectResponse
    {
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide hero berhasil dihapus.');
    }
}