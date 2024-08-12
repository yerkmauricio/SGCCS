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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('apellidop', 30);
            $table->string('apellidom', 30);
            $table->integer('ci');
            $table->string('expedito', 2);
            $table->boolean('genero')->default(true);



            $table->string('cargo', 50);
            $table->string('unidad', 50);
            $table->date('fecha');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
