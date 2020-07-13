<?php

use IllUMinate\Database\Migrations\Migration;
use IllUMinate\Database\Schema\Blueprint;
use IllUMinate\Support\Facades\Schema;

class CreateUnidadMedidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_medida', function (Blueprint $table) {
            $table->bigIncrements("UMId");
            $table->string("UMNombre",30);
            $table->string("UMNombreCorto",10);
            $table->string("UMObservacion",50);
            $table->bigInteger("UMEstadoId")->unsigned();;
            $table->bigInteger("UMUsuarioCrea");
            $table->datetime("UMFechaCrea");
            $table->bigInteger("UMUsuarioModifica")->nullable();
            $table->datetime("UMFechaModifica")->nullable();
            $table->foreign('UMEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidad_medida');
    }
}
