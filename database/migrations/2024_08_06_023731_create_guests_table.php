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
        Schema::create('guests', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('invitationId');
            $table->string('no');
            $table->string('name');
            $table->json('additional')->nullable();
            $table->json('sosmed')->nullable();
            $table->json('attended')->nullable();
            $table->timestamps();

            $table->foreign('invitationId')->references('id')->on('invitations')->onDelete('cascade');

            $table->index('invitationId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
