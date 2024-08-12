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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('apellidopaterno', 20)->notNull();
            $table->string('apellidomaterno', 20)->notNull();
            $table->string('ci', 20)->notNull()->unique();
            $table->string('expedito', 2)->notNull();
            $table->boolean('estado')->notNull();
            $table->string('foto', 100)->notnull();
            $table->boolean('genero')->notNull();
            $table->string('cargo', 30)->notNull();
            $table->string('unidad', 30)->notNull();
            $table->date('fnacimiento')->notNull();
            $table->date('finicio')->notNull();
            $table->date('fsuspension')->nullable();

            $table->date('fecha')->default(now());
            $table->softDeletes(); //eso hace que el borado sea logico

        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
