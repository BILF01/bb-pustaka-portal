<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'institution' => ['nullable', 'string', 'max:255'],
            'purpose' => ['required', 'in:studi_pustaka,wisata_edukasi,penelitian,booking_ruang_rapat'],
            'visit_date' => ['required', 'date', 'after_or_equal:tomorrow'],
            'person_count' => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'visit_date.after_or_equal' => 'Tanggal kunjungan minimal H+1 dari hari ini.',
            'person_count.max' => 'Untuk rombongan lebih dari 100 orang, silakan hubungi kami langsung melalui halaman Kontak.',
        ];
    }
}