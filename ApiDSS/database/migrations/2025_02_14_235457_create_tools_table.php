<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre de la herramienta
            $table->string('description')->nullable(); // Descripción de la herramienta
            $table->integer('quantity')->default(1); // Cantidad de herramientas
            $table->string('location')->nullable(); // Ubicación de la herramienta
            $table->foreignId('user_id')->nullable(); // Relación con Usuario
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
