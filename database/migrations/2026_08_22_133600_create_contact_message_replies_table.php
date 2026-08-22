<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'contact_message_replies',
            function (Blueprint $table): void {
                $table->id();

                $table
                    ->foreignId('contact_message_id')
                    ->constrained('contact_messages')
                    ->cascadeOnDelete();

                $table
                    ->unsignedBigInteger('user_id')
                    ->nullable();

                $table->string('recipient_email');
                $table->string('subject');
                $table->text('message');

                $table
                    ->string('delivery_status', 20)
                    ->default('pending');

                $table
                    ->string('mailer', 50)
                    ->nullable();

                $table
                    ->text('error_message')
                    ->nullable();

                $table
                    ->timestamp('sent_at')
                    ->nullable();

                $table->timestamps();

                $table->index([
                    'contact_message_id',
                    'created_at',
                ]);

                $table->index([
                    'delivery_status',
                    'created_at',
                ]);

                $table->index('user_id');
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_message_replies');
    }
};