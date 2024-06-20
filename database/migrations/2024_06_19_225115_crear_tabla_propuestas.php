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
        Schema::create('propuestas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('personas_id')->unique();
            $table->foreign('personas_id','fk_propuesta_personas')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('titulo',255);
            $table->string('codigo',255)->unique();
            $table->longText('descripcion')->nullable();
            $table->float('promedio_primera')->nullable();
            $table->float('promedio_segunda')->nullable();
            $table->string('informe',255)->nullable();
            $table->string('sector',255)->nullable();
            $table->string('annos',255)->nullable();
            $table->string('meses',255)->nullable();
            $table->integer('estado')->nullable()->default(1);
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propuestas');
    }
};
