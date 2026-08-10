<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = ['satisfaction_level', 'found_information', 'message', 'desired_feature'];

    protected $casts = [
        'satisfaction_level' => 'integer',
        'found_information' => 'boolean',
    ];

    public function satisfactionEmoji(): string
    {
        return match ($this->satisfaction_level) {
            1 => '😞', 2 => '😐', 3 => '🙂', 4 => '😄', 5 => '🥰',
            default => '❓',
        };
    }
}