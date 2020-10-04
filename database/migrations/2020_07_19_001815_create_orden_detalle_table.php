<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_detalle', function (Blueprint $table) {
            $table->bigIncrements("ODId");
            $table->bigInteger("ODOrdenId")->unsigned();
            $table->bigInteger("ODProductoId")->unsigned();
            $table->bigInteger("ordenEstadoId")->unsigned();
            $table->foreign('ODOrdenId')->references('ordenId')->on('orden')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ODProductoId')->references('productoId')->on('producto')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ordenEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_detalle');
    }
}
