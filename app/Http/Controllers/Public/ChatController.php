<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChatMessageRequest;
use App\Models\ChatSession;
use App\Services\Chatbot\ChatProviderFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class ChatController extends Controller
{
    public function startSession(Request $request): JsonResponse
    {
        $visitorToken = $request->string('visitor_token')->toString() ?: (string) Str::uuid();

        $session = ChatSession::create([
            'visitor_token' => $visitorToken,
        ]);

        return response()->json([
            'session_uuid' => $session->uuid,
            'visitor_token' => $visitorToken,
        ]);
    }

    public function messages(ChatSession $session): JsonResponse
    {
        return response()->json(
            $session->messages()->get(['role', 'content', 'created_at'])
        );
    }

    public function sendMessage(StoreChatMessageRequest $request, ChatSession $session): JsonResponse
    {
        $session->messages()->create([
            'role' => 'user',
            'content' => $request->validated('message'),
        ]);

        $history = $session->messages()
            ->get(['role', 'content'])
            ->map(fn ($message): array => ['role' => $message->role, 'content' => $message->content])
            ->toArray();

        $payload = [
            ['role' => 'system', 'content' => config('chatbot.system_prompt')],
            ...$history,
        ];

        try {
            $reply = ChatProviderFactory::make()->reply($payload);
        } catch (Throwable $e) {
            report($e);
            $reply = 'Maaf, terjadi kendala teknis saat menghubungi asisten AI. Silakan coba lagi nanti atau hubungi kami melalui halaman Kontak.';
        }

        $assistantMessage = $session->messages()->create([
            'role' => 'assistant',
            'content' => $reply,
        ]);

        return response()->json([
            'reply' => $assistantMessage->content,
            'created_at' => $assistantMessage->created_at,
        ]);
    }
}