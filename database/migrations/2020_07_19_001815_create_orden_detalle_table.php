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
            $table->decimal("ODCantidad", 8, 2);
            $table->foreign('ODOrdenId')->references('ordenId')->on('orden')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ODProductoId')->references('productoId')->on('producto')->onDelete('cascade')->onUpdate('cascade');
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
