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
        Schema::create('sumarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('apellidop', 30)->nullable();
            $table->string('apellidom', 30)->nullable();
            $table->integer('ci')->inique();
            $table->string('extension', 2)->nullable();
            $table->string('expedido', 2);
            $table->boolean('genero');
            $table->string('nacionalidad', 30);
            $table->date('fnanciamineto');
            $table->string('whatsapp', 15)->unique();
            $table->string('institucion',50)->nullable();
            
            $table->unsignedBigInteger('tipo_persona_id')->nullable();
            $table->foreign('tipo_persona_id')->references('id')
            ->on('tipo_personas')->onDelete('cascade')->nullable();
            
            $table->string('unidad', 50)->nullable();
            $table->string('cargo', 50)->nullable();
            $table->string('domicilioreal', 50)->nullable();
            $table->string('domiciliolegal', 50)->nullable();
            $table->string('domicilioconvencional', 50)->nullable();
            $table->string('gmail', 50);
            $table->date('fecha');
            $table->string('foto', 100);
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumarios');
    }
};
