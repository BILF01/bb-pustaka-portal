<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'collection_category_id' => ['required', 'exists:collection_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'published_year' => ['nullable', 'integer', 'min:1900', 'max:'.(date('Y') + 1)],
            'isbn' => ['nullable', 'string', 'max:20'],
            'page_count' => ['nullable', 'string', 'max:50'],
            'access_link' => ['nullable', 'url', 'max:255'],
            'synopsis' => ['nullable', 'string'],
            'cover' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['sometimes', 'boolean'],
        ];
    }
}