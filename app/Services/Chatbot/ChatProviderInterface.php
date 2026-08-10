<?php

declare(strict_types=1);

namespace App\Services\Chatbot;

interface ChatProviderInterface
{
    /**
     * @param array<int, array{role: string, content: string}> $messages
     */
    public function reply(array $messages): string;
}