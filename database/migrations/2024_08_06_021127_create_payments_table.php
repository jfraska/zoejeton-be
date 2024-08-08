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
        Schema::create('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('invitationId')->unique();
            $table->string('desc');
            $table->json('items');
            $table->integer('discount')->default(0);
            $table->integer('total');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('payments');
    }
};
