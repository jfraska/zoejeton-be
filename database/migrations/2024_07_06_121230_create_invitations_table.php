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
        Schema::create('invitations', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->string('userId');
            $table->string('templateId')->unique()->nullable();
            $table->json('fitur');
            $table->json('addon');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Definisikan foreign key dan relasi
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('templateId')->references('id')->on('templates')->onDelete('cascade');

            // Buat index
            $table->index(['templateId', 'userId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
