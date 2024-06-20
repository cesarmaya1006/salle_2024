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
        Schema::create('fotos', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('prim_fase_componente_id');
            $table->foreign('prim_fase_componente_id', 'fk_fotos_prim_fase_componentes')->references('id')->on('prim_fase_componentes')->onDelete('restrict')->onUpdate('restrict');
            $table->string('titulo',255)->nullable();
            $table->string('foto',255);
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
        Schema::dropIfExists('fotos');
    }
};
