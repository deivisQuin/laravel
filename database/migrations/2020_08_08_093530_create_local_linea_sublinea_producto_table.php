<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalLineaSublineaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_linea_sublinea_producto', function (Blueprint $table) {
            $table->bigIncrements("LLSPId");
            $table->bigInteger("LLSPLocalId")->unsigned();
            $table->bigInteger("LLSPLineaId")->unsigned();
            $table->bigInteger("LLSPSublineaId")->unsigned();
            $table->bigInteger("LLSPProductoId")->unsigned();
            $table->integer("LLSPPosicion")->nullable();
            $table->decimal("LLSPPrecio", 8, 2);
            $table->bigInteger("LLSPEstadoId")->unsigned();
            $table->string("LLSPImagen",20);
            $table->foreign('LLSPEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('LLSPLocalId')->references('localId')->on('local')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('LLSPLineaId')->references('lineaId')->on('linea')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('LLSPSublineaId')->references('sublineaId')->on('sublinea')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('LLSPProductoId')->references('productoId')->on('producto')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_linea_sublinea_producto');
    }
}
