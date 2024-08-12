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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('apellidop', 30)->nullable();
            $table->string('apellidom', 30)->nullable();
            $table->integer('ci')->nullable();
            $table->string('expedito', 2)->nullable();
            $table->boolean('genero');
            $table->string('nacionalidad', 30)->nullable();
            $table->date('fnacimiento')->nullable();
            $table->string('whatsapp', 15)->unique();

            $table->unsignedBigInteger('tipo_persona_id')->nullable();
            $table->foreign('tipo_persona_id')->references('id')
                ->on('tipo_personas')->onDelete('cascade')->nullable();
            $table->string('categoria', 30)->nullable();
            $table->string('institucion', 50)->nullable();
            $table->string('unidad', 50)->nullable();
            $table->string('cargo', 50)->nullable();
            $table->string('carrera', 50)->nullable();
            $table->string('sede', 50)->nullable();
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
        Schema::dropIfExists('personas');
    }
};
