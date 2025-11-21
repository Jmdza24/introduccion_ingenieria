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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('visitante_id')->constrained('visitantes')->onDelete('cascade');
            $table->foreignId('apartamento_id')->constrained('apartamentos')->onDelete('cascade');

            $table->date('fecha_ingreso');
            $table->time('hora_ingreso');

            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
