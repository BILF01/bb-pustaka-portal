<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyContactMessageRequest;
use App\Mail\ContactMessageReply as ContactMessageReplyMail;
use App\Models\ContactMessage;
use App\Models\ContactMessageReply;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContactMessage::query()->latest();

        if ($request->filled('q')) {
            $search = trim((string) $request->query('q'));

            $query->where(function (Builder $query) use ($search): void {
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->query('status') === 'unread') {
            $query->where('is_read', false);
        }

        if ($request->query('status') === 'read') {
            $query->where('is_read', true);
        }

        $handlingStatus = (string) $request->query(
            'handling_status',
            ''
        );

        if (in_array(
            $handlingStatus,
            ContactMessage::HANDLING_STATUSES,
            true
        )) {
            $query->where(
                'handling_status',
                $handlingStatus
            );
        }

        $messages = $query
            ->paginate(15)
            ->withQueryString();

        $totalMessages = ContactMessage::query()->count();

        $unreadMessages = ContactMessage::query()
            ->where('is_read', false)
            ->count();

        $readMessages = $totalMessages - $unreadMessages;

        $pendingMessages = ContactMessage::query()
            ->where(
                'handling_status',
                ContactMessage::STATUS_PENDING
            )
            ->count();

        $inProgressMessages = ContactMessage::query()
            ->where(
                'handling_status',
                ContactMessage::STATUS_IN_PROGRESS
            )
            ->count();

        $resolvedMessages = ContactMessage::query()
            ->where(
                'handling_status',
                ContactMessage::STATUS_RESOLVED
            )
            ->count();

        $archivedMessages = ContactMessage::query()
            ->where(
                'handling_status',
                ContactMessage::STATUS_ARCHIVED
            )
            ->count();

        return view(
            'admin.contact-messages.index',
            compact(
                'messages',
                'totalMessages',
                'unreadMessages',
                'readMessages',
                'pendingMessages',
                'inProgressMessages',
                'resolvedMessages',
                'archivedMessages'
            )
        );
    }

    public function show(
        ContactMessage $contactMessage
    ): View {
        if (! $contactMessage->is_read) {
            $contactMessage->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }

        $contactMessage->load([
            'replies' => function ($query): void {
                $query->oldest();
            },
        ]);

        return view(
            'admin.contact-messages.show',
            compact('contactMessage')
        );
    }

    public function reply(
        ReplyContactMessageRequest $request,
        ContactMessage $contactMessage
    ): RedirectResponse {
        $validated = $request->validated();

        $mailer = (string) config(
            'mail.default',
            'log'
        );

        $reply = ContactMessageReply::query()->create([
            'contact_message_id' => $contactMessage->id,
            'user_id' => auth()->id(),
            'recipient_email' => $contactMessage->email,
            'subject' => $validated['subject'],
            'message' => $validated['reply_message'],
            'delivery_status' => ContactMessageReply::STATUS_PENDING,
            'mailer' => $mailer,
        ]);

        try {
            Mail::to($contactMessage->email)->send(
                new ContactMessageReplyMail(
                    contactMessage: $contactMessage,
                    subjectLine: $validated['subject'],
                    replyMessage: $validated['reply_message']
                )
            );

            if ($mailer === 'log') {
                $reply->update([
                    'delivery_status' => ContactMessageReply::STATUS_LOGGED,
                    'error_message' => null,
                    'sent_at' => null,
                ]);
            } else {
                $reply->update([
                    'delivery_status' => ContactMessageReply::STATUS_SENT,
                    'error_message' => null,
                    'sent_at' => now(),
                ]);
            }

            if (
                $contactMessage->handling_status ===
                ContactMessage::STATUS_PENDING
            ) {
                $contactMessage->update([
                    'handling_status' =>
                        ContactMessage::STATUS_IN_PROGRESS,
                ]);
            }
        } catch (Throwable $exception) {
            $reply->update([
                'delivery_status' =>
                    ContactMessageReply::STATUS_FAILED,
                'error_message' =>
                    $exception->getMessage(),
                'sent_at' => null,
            ]);

            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Balasan gagal diproses. Riwayat kegagalan telah dicatat.'
                );
        }

        if ($mailer === 'log') {
            return back()->with(
                'success',
                'Balasan berhasil dicatat dalam mode pengujian. Email belum dikirim ke alamat nyata.'
            );
        }

        return back()->with(
            'success',
            'Balasan berhasil dikirim ke '.
                $contactMessage->email.'.'
        );
    }

    public function updateStatus(
        Request $request,
        ContactMessage $contactMessage
    ): RedirectResponse {
        $validated = $request->validate([
            'handling_status' => [
                'required',
                'string',
                Rule::in(
                    ContactMessage::HANDLING_STATUSES
                ),
            ],
        ]);

        $contactMessage->update([
            'handling_status' =>
                $validated['handling_status'],
        ]);

        return back()->with(
            'success',
            'Status penanganan diperbarui menjadi '.
                $contactMessage->handlingStatusLabel().'.'
        );
    }

    public function unread(
        ContactMessage $contactMessage
    ): RedirectResponse {
        $contactMessage->update([
            'is_read' => false,
            'read_at' => null,
        ]);

        return redirect()
            ->route('admin.contact-messages.index')
            ->with(
                'success',
                'Pesan ditandai belum dibaca.'
            );
    }
}