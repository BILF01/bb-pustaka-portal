<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agendas', function (Blueprint $table): void {
            $table->string('category')->nullable()->after('location');
            $table->string('image_path')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table): void {
            $table->dropColumn(['category', 'image_path']);
        });
    }
};