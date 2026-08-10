<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequestRequest;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceRequestController extends Controller
{
    public function create(ServiceRequestType $type): View
    {
        return view('pages.service-requests.create', compact('type'));
    }

    public function store(StoreServiceRequestRequest $request): RedirectResponse
    {
        ServiceRequest::create($request->validated());

        return redirect()
            ->route('home')
            ->with('success', 'Pengajuan Anda berhasil dikirim. Kami akan memprosesnya secepatnya.');
    }
}