<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('external_service_links', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique()->comment('Kode unik: opac, repository, ebook, dst.');
            $table->string('name');
            $table->string('icon')->default('link');
            $table->string('description')->nullable();
            $table->enum('integration_mode', ['native', 'hybrid', 'external'])->default('external');
            $table->string('external_url')->nullable();
            $table->string('native_route')->nullable()->comment('Nama named-route jika integration_mode native/hybrid');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('external_service_links');
    }
};