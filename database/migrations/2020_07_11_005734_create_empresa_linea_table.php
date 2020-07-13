<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaLineaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
        Schema::create('empresa_linea', function (Blueprint $table) {
            $table->bigIncrements("empresaLineaId");
            $table->bigInteger("empresaLineaEmpresaId")->unsigned();
            $table->bigInteger("empresaLineaLineaId")->unsigned();
            $table->foreign('empresaLineaEmpresaId')->references('empresaId')->on('empresa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empresaLineaLineaId')->references('lineaId')->on('linea')->onDelete('cascade')->onUpdate('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_linea');
    }
}
