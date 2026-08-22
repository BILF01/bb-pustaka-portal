<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table): void {
            $table->boolean('is_active')->default(true)->after('order');

            $table->index(['is_active', 'order']);
        });
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table): void {
            $table->dropIndex(['is_active', 'order']);
            $table->dropColumn('is_active');
        });
    }
};