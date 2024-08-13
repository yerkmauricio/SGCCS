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
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('mae');
            $table->string('nfolio', 30);
            $table->text('identificacion_caso');
            $table->boolean('estado');

     
            $table->unsignedBigInteger('tipo_caso_id')->nullable();//llave foranea
            $table->foreign('tipo_caso_id')->references('id')
                ->on('tipo_casos')->onDelete('cascade');//no olvidar la "s"
                
       
            $table->unsignedBigInteger('actua_id')->nullable();
            $table->foreign('actua_id')->references('id')
                ->on('actuas')->onDelete('cascade');

            $table->string('hoja_ruta');
            $table->string('remitente', 90);
            $table->date('radicatoria');
            $table->string('adm', 10);

            $table->unsignedBigInteger('sumario_id')->nullable();
            $table->foreign('sumario_id')->references('id')
                ->on('sumarios')->onDelete('cascade');


            $table->text('antecedentes');
            $table->date('ejecutoria');
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
        Schema::dropIfExists('casos');
    }
};
