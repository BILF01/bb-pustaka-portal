<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'satisfaction_level' => ['required', 'integer', 'between:1,5'],
            'found_information' => ['required', 'boolean'],
            'message' => ['required', 'string', 'max:500'],
            'desired_feature' => ['nullable', 'string', 'max:500'],
        ];
    }
}