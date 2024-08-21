<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('guest')->default(50);
            $table->integer('whatsapp')->default(50);
            $table->decimal('media', 10, 2)->default(10);
            $table->integer('guestbook')->default(0);
            $table->json('template')->nullable();
            $table->boolean('fitur_premiun')->default(false);
            $table->boolean('custom_domain')->default(false);
            $table->timestamps();

            $table->foreignUuid('invitationId')->references('id')->on('invitations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
