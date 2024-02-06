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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titular'); // Titular o persona que reserva
            $table->dateTime('fecha_inicio'); // Fecha y hora de inicio
            $table->dateTime('fecha_salida'); // Fecha y hora de fin
            $table->enum('estado', ['prereservado', 'reservado', 'disponible']); // Estado del evento
            $table->text('descripcion')->nullable(); // Comentario
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
        Schema::dropIfExists('eventos');
    }
};
