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
        Schema::create('prim_fase_notas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('prim_fase_componentes_id');
            $table->foreign('prim_fase_componentes_id', 'fk_componente_prim_fase_componentes')->references('id')->on('prim_fase_componentes')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('personas_id');
            $table->foreign('personas_id', 'fk_jurado_personas')->references('id')->on('personas')->onDelete('restrict')->onUpdate('restrict');
            $table->float('calificacion')->default(0);
            $table->longText('observacion')->nullable();
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
        Schema::dropIfExists('prim_fase_notas');
    }
};
