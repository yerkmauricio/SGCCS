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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('idp')->constrained('persona');
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')
                ->on('personas')->onDelete('cascade');

            // $table->foreignId('idu')->constrained('usuarios');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')
                ->on('usuarios')->onDelete('cascade');

            // $table->foreignId('idm')->constrained('mensajes');
            $table->unsignedBigInteger('mensaje_id');
            $table->foreign('mensaje_id')->references('id')
                ->on('mensajes')->onDelete('cascade');

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
        Schema::dropIfExists('registros');
    }
};
