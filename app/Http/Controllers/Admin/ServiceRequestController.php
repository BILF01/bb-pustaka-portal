<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ServiceRequestController extends Controller
{
    public function index(): View
    {
        return view('admin.dummy', [
            'title' => 'Pengajuan Layanan',
            'message' => 'Modul pengajuan layanan publik dikelola melalui sistem terpisah.',
        ]);
    }
}