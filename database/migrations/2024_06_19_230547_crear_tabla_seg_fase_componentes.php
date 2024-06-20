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
        Schema::create('seg_fase_componentes', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('propuestas_id');
            $table->foreign('propuestas_id', 'fk_componente_dos_propuestas')->references('id')->on('propuestas')->onDelete('restrict')->onUpdate('restrict');
            $table->string('componente',255);
            $table->float('not_promedio')->nullable();
            $table->longText('observacion')->nullable();
            $table->integer('estado')->default(0);
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
        Schema::dropIfExists('seg_fase_componentes');
    }
};
