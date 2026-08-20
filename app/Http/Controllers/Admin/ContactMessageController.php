<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()->latest()->paginate(15);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage): View
    {
        if (! $contactMessage->is_read) {
            $contactMessage->update(['is_read' => true, 'read_at' => now()]);
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function unread(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->update(['is_read' => false, 'read_at' => null]);

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Pesan ditandai belum dibaca.');
    }
}