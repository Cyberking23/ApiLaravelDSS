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
            $table->string('name');
            $table->string('description'); 
            $table->integer('quantity'); 
            $table->string('location'); 
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
