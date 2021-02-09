<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements("productoId");
            $table->string("productoNombre",30);
            $table->string("productoNombreCorto",10);
            $table->string("productoNombreExtenso",100);
            $table->string("productoObservacion",50)->nullable();
            $table->longText("productoIngrediente")->nullable();
            $table->bigInteger("productoUnidadMedidaId")->unsigned();
            $table->bigInteger("productoSublineaId")->unsigned();
            $table->bigInteger("productoEstadoId")->unsigned();
            $table->bigInteger("productoUsuarioCrea");
            $table->datetime("productoFechaCrea");
            $table->bigInteger("productoUsuarioModifica")->nullable();
            $table->datetime("productoFechaModifica")->nullable();
            $table->foreign('productoUnidadMedidaId')->references('UMId')->on('unidad_medida')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('productoSublineaId')->references('sublineaId')->on('sublinea')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('productoEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
