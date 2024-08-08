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
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('invitationId');
            $table->string('no');
            $table->string('name');
            $table->json('additional');
            $table->json('sosmed');
            $table->json('attended');
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
