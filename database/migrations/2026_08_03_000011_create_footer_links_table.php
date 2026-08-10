<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_links', function (Blueprint $table): void {
            $table->id();
            $table->enum('group', ['quick_links', 'information', 'social'])->index();
            $table->string('label');
            $table->string('url');
            $table->string('icon')->nullable()->comment('Nama icon Material Symbols, khusus grup social biasanya diisi nama SVG kustom');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_links');
    }
};