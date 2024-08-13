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
        Schema::create('resolucion_finals', function (Blueprint $table) {
            $table->id();
            $table->date('apertura');
            $table->text('descripcion');
            
            $table->unsignedBigInteger('caso_id')->nullable();
            $table->foreign('caso_id')->references('id')
                ->on('casos')->onDelete('cascade');
     
            $table->date('fecha');
            $table->softDeletes();//boraado logico
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resolucion_finals');
    }
};
