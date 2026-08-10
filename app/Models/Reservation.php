<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'institution',
        'purpose',
        'visit_date',
        'person_count',
        'status',
        'admin_note',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'person_count' => 'integer',
    ];

    public function purposeLabel(): string
    {
        return match ($this->purpose) {
            'studi_pustaka' => 'Studi Pustaka',
            'wisata_edukasi' => 'Wisata Edukasi',
            'penelitian' => 'Penelitian',
            'booking_ruang_rapat' => 'Booking Ruang Rapat',
        };
    }
}