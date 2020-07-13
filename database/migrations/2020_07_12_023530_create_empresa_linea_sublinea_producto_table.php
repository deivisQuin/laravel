<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaLineaSublineaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_linea_sublinea_producto', function (Blueprint $table) {
            $table->bigIncrements("ELSPId");
            $table->bigInteger("ELSPEmpresaId")->unsigned();
            $table->bigInteger("ELSPLineaId")->unsigned();
            $table->bigInteger("ELSPSublineaId")->unsigned();
            $table->bigInteger("ELSPProductoId")->unsigned();
            $table->foreign('ELSPEmpresaId')->references('empresaId')->on('empresa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ELSPLineaId')->references('lineaId')->on('linea')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ELSPSublineaId')->references('sublineaId')->on('sublinea')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ELSPProductoId')->references('productoId')->on('producto')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_linea_sublinea_producto');
    }
}
