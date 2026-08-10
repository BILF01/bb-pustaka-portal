<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table): void {
            $table->id();
            $table->string('full_name');
            $table->string('institution')->nullable();
            $table->enum('purpose', ['studi_pustaka', 'wisata_edukasi', 'penelitian', 'booking_ruang_rapat']);
            $table->date('visit_date');
            $table->unsignedInteger('person_count')->default(1);
            $table->enum('status', ['pending', 'confirmed', 'rejected', 'completed'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->timestamps();

            $table->index(['visit_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};