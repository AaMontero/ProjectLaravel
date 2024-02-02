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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titular o persona que reserva
            $table->dateTime('start_datetime'); // Fecha y hora de inicio
            $table->dateTime('end_datetime'); // Fecha y hora de fin
            $table->enum('status', ['prereservado', 'reservado', 'disponible']); // Estado del evento
            $table->text('comment')->nullable(); // Comentario
            $table->unsignedBigInteger('user_id'); // ID del usuario que registra la reserva
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
