<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request): RedirectResponse
    {
        Reservation::create($request->validated());

        return redirect()
            ->route('home')
            ->with('success', 'Reservasi kunjungan berhasil diajukan. Tim kami akan menghubungi Anda untuk konfirmasi.');
    }
}