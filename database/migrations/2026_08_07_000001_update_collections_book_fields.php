<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('collections', function (Blueprint $table): void {
            $table->string('page_count')->nullable()->after('isbn');
            $table->string('access_link')->nullable()->after('page_count');
            $table->dropColumn('stock');
        });
    }

    public function down(): void
    {
        Schema::table('collections', function (Blueprint $table): void {
            $table->dropColumn(['page_count', 'access_link']);
            $table->unsignedInteger('stock')->default(0);
        });
    }
};