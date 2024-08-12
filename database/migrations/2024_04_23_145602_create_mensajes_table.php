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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('tipo_mensaje_id')->constrained('tipo_mensajes');

            $table->unsignedBigInteger('tipo_mensaje_id')->nullable();
            $table->foreign('tipo_mensaje_id')->references('id')
                ->on('tipo_mensajes')->onDelete('cascade');

            $table->unsignedBigInteger('tipo_persona_id');
            $table->foreign('tipo_persona_id')->references('id')
                ->on('tipo_personas')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('mensajes');
    }
};
