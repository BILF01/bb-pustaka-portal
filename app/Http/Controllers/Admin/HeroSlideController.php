<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHeroSlideRequest;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    private const MAX_ACTIVE_SLIDES = 5;

    public function index(): View
    {
        $heroSlides = HeroSlide::ordered()->get();
        $activeCount = $heroSlides->where('is_active', true)->count();
        $maxActiveSlides = self::MAX_ACTIVE_SLIDES;

        return view(
            'admin.hero-slides.index',
            compact('heroSlides', 'activeCount', 'maxActiveSlides')
        );
    }

    public function create(): View
    {
        $activeCount = HeroSlide::active()->count();
        $maxActiveSlides = self::MAX_ACTIVE_SLIDES;
        $canActivate = $activeCount < $maxActiveSlides;
        $maxOrder = HeroSlide::query()->count() + 1;

        return view(
            'admin.hero-slides.create',
            compact(
                'activeCount',
                'maxActiveSlides',
                'canActivate',
                'maxOrder'
            )
        );
    }

    public function store(StoreHeroSlideRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $isActive = $request->boolean('is_active');

        DB::transaction(function () use ($request, $validated, $isActive): void {
            $this->normalizeOrders();

            if (
                $isActive
                && HeroSlide::active()->count() >= self::MAX_ACTIVE_SLIDES
            ) {
                throw ValidationException::withMessages([
                    'is_active' => 'Maksimal '.self::MAX_ACTIVE_SLIDES.' banner utama dapat aktif secara bersamaan.',
                ]);
            }

            $count = HeroSlide::query()->count();

            $targetOrder = isset($validated['order'])
                && $validated['order'] !== null
                    ? max(1, min((int) $validated['order'], $count + 1))
                    : $count + 1;

            HeroSlide::query()
                ->where('order', '>=', $targetOrder)
                ->increment('order');

            HeroSlide::create([
                'image_path' => Storage::disk('public')->url(
                    $request->file('image')->store('hero-slides', 'public')
                ),
                'order' => $targetOrder,
                'is_active' => $isActive,
            ]);
        });

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Banner utama berhasil ditambahkan.');
    }

    public function edit(HeroSlide $heroSlide): View
    {
        $activeCount = HeroSlide::active()->count();
        $maxActiveSlides = self::MAX_ACTIVE_SLIDES;
        $canActivate = $heroSlide->is_active
            || $activeCount < $maxActiveSlides;
        $maxOrder = max(1, HeroSlide::query()->count());

        return view(
            'admin.hero-slides.edit',
            compact(
                'heroSlide',
                'activeCount',
                'maxActiveSlides',
                'canActivate',
                'maxOrder'
            )
        );
    }

    public function update(
        StoreHeroSlideRequest $request,
        HeroSlide $heroSlide
    ): RedirectResponse {
        $validated = $request->validated();
        $isActive = $request->boolean('is_active');

        DB::transaction(function () use (
            $request,
            $validated,
            $isActive,
            $heroSlide
        ): void {
            $this->normalizeOrders();

            $current = HeroSlide::query()
                ->whereKey($heroSlide->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $isActive
                && ! $current->is_active
                && HeroSlide::active()->count() >= self::MAX_ACTIVE_SLIDES
            ) {
                throw ValidationException::withMessages([
                    'is_active' => 'Maksimal '.self::MAX_ACTIVE_SLIDES.' banner utama dapat aktif secara bersamaan.',
                ]);
            }

            $count = HeroSlide::query()->count();
            $currentOrder = (int) $current->order;

            $requestedOrder = $validated['order'] ?? $currentOrder;

            $targetOrder = max(
                1,
                min((int) $requestedOrder, $count)
            );

            if ($targetOrder < $currentOrder) {
                HeroSlide::query()
                    ->where('order', '>=', $targetOrder)
                    ->where('order', '<', $currentOrder)
                    ->increment('order');
            } elseif ($targetOrder > $currentOrder) {
                HeroSlide::query()
                    ->where('order', '>', $currentOrder)
                    ->where('order', '<=', $targetOrder)
                    ->decrement('order');
            }

            $data = [
                'order' => $targetOrder,
                'is_active' => $isActive,
            ];

            if ($request->hasFile('image')) {
                $data['image_path'] = Storage::disk('public')->url(
                    $request->file('image')->store('hero-slides', 'public')
                );
            }

            $current->update($data);
        });

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Banner utama berhasil diperbarui.');
    }

    public function toggleActive(HeroSlide $heroSlide): RedirectResponse
    {
        if ($heroSlide->is_active) {
            $heroSlide->update(['is_active' => false]);

            return redirect()
                ->route('admin.hero-slides.index')
                ->with('success', 'Banner berhasil dinonaktifkan.');
        }

        if (HeroSlide::active()->count() >= self::MAX_ACTIVE_SLIDES) {
            return redirect()
                ->route('admin.hero-slides.index')
                ->with(
                    'error',
                    'Maksimal '.self::MAX_ACTIVE_SLIDES.' banner utama dapat aktif secara bersamaan.'
                );
        }

        $heroSlide->update(['is_active' => true]);

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Banner berhasil diaktifkan.');
    }

    public function activateTop(): RedirectResponse
    {
        $activatedCount = DB::transaction(function (): int {
            $this->normalizeOrders();

            $topIds = HeroSlide::ordered()
                ->limit(self::MAX_ACTIVE_SLIDES)
                ->pluck('id');

            HeroSlide::query()->update([
                'is_active' => false,
            ]);

            if ($topIds->isNotEmpty()) {
                HeroSlide::query()
                    ->whereIn('id', $topIds)
                    ->update([
                        'is_active' => true,
                    ]);
            }

            return $topIds->count();
        });

        return redirect()
            ->route('admin.hero-slides.index')
            ->with(
                'success',
                $activatedCount.' banner teratas berhasil diaktifkan.'
            );
    }

    public function deactivateAll(): RedirectResponse
    {
        $deactivatedCount = HeroSlide::query()
            ->where('is_active', true)
            ->update([
                'is_active' => false,
            ]);

        return redirect()
            ->route('admin.hero-slides.index')
            ->with(
                'success',
                $deactivatedCount > 0
                    ? 'Semua banner utama berhasil dinonaktifkan.'
                    : 'Tidak ada banner aktif yang perlu dinonaktifkan.'
            );
    }

    public function destroy(HeroSlide $heroSlide): RedirectResponse
    {
        DB::transaction(function () use ($heroSlide): void {
            $this->normalizeOrders();

            $current = HeroSlide::query()
                ->whereKey($heroSlide->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            $deletedOrder = (int) $current->order;

            $current->delete();

            HeroSlide::query()
                ->where('order', '>', $deletedOrder)
                ->decrement('order');
        });

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Banner utama berhasil dihapus.');
    }

    private function normalizeOrders(): void
    {
        $slides = HeroSlide::query()
            ->ordered()
            ->lockForUpdate()
            ->get(['id', 'order']);

        foreach ($slides as $index => $slide) {
            $position = $index + 1;

            if ((int) $slide->order === $position) {
                continue;
            }

            HeroSlide::query()
                ->whereKey($slide->getKey())
                ->update([
                    'order' => $position,
                ]);
        }
    }
}