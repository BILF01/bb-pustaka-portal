<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table): void {
            $table
                ->string('handling_status', 20)
                ->default('pending')
                ->after('read_at');

            $table->index([
                'handling_status',
                'created_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table): void {
            $table->dropIndex([
                'handling_status',
                'created_at',
            ]);

            $table->dropColumn('handling_status');
        });
    }
};