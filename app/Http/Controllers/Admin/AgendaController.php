<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgendaRequest;
use App\Models\Agenda;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Agenda::query()->orderByDesc('starts_at');

        if ($request->filled('q')) {
            $search = trim((string) $request->query('q'));

            $query->where(function (Builder $query) use ($search): void {
                $query
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->query('category'));
        }

        if ($request->query('status') === 'upcoming') {
            $query->where('starts_at', '>', now());
        }

        if ($request->query('status') === 'ongoing') {
            $query
                ->where('starts_at', '<=', now())
                ->whereRaw(
                    'COALESCE(ends_at, starts_at) >= ?',
                    [now()]
                );
        }

        if ($request->query('status') === 'completed') {
            $query->whereRaw(
                'COALESCE(ends_at, starts_at) < ?',
                [now()]
            );
        }

        $agendas = $query
            ->paginate(15)
            ->withQueryString();

        $categories = $this->categories();

        return view(
            'admin.agendas.index',
            compact('agendas', 'categories')
        );
    }

    public function create(): View
    {
        $categories = $this->categories();

        return view(
            'admin.agendas.create',
            compact('categories')
        );
    }

    public function store(
        StoreAgendaRequest $request
    ): RedirectResponse {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image_path'] = Storage::disk('public')->url(
                $request->file('image')->store('agendas', 'public')
            );
        }

        Agenda::create($validated);

        return redirect()
            ->route('admin.agendas.index')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda): View
    {
        $categories = $this->categories();

        return view(
            'admin.agendas.edit',
            compact('agenda', 'categories')
        );
    }

    public function update(
        StoreAgendaRequest $request,
        Agenda $agenda
    ): RedirectResponse {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image_path'] = Storage::disk('public')->url(
                $request->file('image')->store('agendas', 'public')
            );
        }

        $agenda->update($validated);

        return redirect()
            ->route('admin.agendas.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(
        Agenda $agenda
    ): RedirectResponse {
        $agenda->delete();

        return redirect()
            ->route('admin.agendas.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }

    private function categories(): Collection
    {
        return Agenda::query()
            ->whereNotNull('category')
            ->where('category', '<>', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');
    }
}