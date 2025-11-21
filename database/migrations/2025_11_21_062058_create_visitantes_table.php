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
        Schema::create('visitantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('identificacion')->unique();
            $table->string('celular');
            $table->enum('tipo_visitante', ['normal', 'trabajador']);
            $table->string('oficio')->nullable(); // solo si es trabajador
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitantes');
    }
};
