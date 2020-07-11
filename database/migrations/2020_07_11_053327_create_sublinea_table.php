<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSublineaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sublinea', function (Blueprint $table) {
            $table->bigIncrements("sublineaId");
            $table->string("sublineaNombre",20);
            $table->string("sublineaNombreCorto",10)->nullable();
            $table->bigInteger("sublineaLineaId")->unsigned();
            $table->bigInteger("sublineaEstadoId")->unsigned();
            $table->foreign('sublineaLineaId')->references('lineaId')->on('linea')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sublineaEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sublinea');
    }
}
