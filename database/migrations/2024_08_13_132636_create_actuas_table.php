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
        Schema::create('actuas', function (Blueprint $table) {
            $table->id();//autoincrementable

            $table->string('nombre', 30);
            $table->text('descripcion');
            $table->boolean('estado')->default(true);
            // $table->integer('gravedad',1);
            $table->date('fecha');
            $table->string('documento')->nullable(); // Para almacenar la ruta del PDF
            $table->softDeletes();//boraado logico
            $table->timestamps();//elimiancion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actuas');
    }
};
