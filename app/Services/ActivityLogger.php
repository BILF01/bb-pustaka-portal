<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ActivityLogger
{
    public static function record(
        User $actor,
        string $action,
        string $description,
        ?Model $subject = null,
        ?string $subjectName = null,
        array $properties = []
    ): ActivityLog {
        $request = request();

        return ActivityLog::query()->create([
            'actor_id' => $actor->getKey(),
            'action' => $action,
            'subject_type' => $subject?->getMorphClass(),
            'subject_id' => $subject?->getKey(),
            'subject_name' => $subjectName,
            'description' => $description,
            'properties' => $properties ?: null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}