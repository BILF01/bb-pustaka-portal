<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        return view('admin.dummy', [
            'title' => 'Reservasi Kunjungan',
            'message' => 'Modul reservasi kunjungan & booking ruang rapat dikelola melalui sistem terpisah.',
        ]);
    }
}