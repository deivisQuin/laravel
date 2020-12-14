<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalUbigeoDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_ubigeo_delivery', function (Blueprint $table) {
            $table->bigIncrements("LUId");
            $table->bigInteger("LULocalId")->unsigned();
            $table->bigInteger("LUUbigeoId")->unsigned();
            $table->decimal("LUPrecioDelivery", 8, 2);
            $table->bigInteger("LUEstadoId")->unsigned();
            $table->foreign('LUEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('LULocalId')->references('localId')->on('local')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('LUUbigeoId')->references('ubigeoId')->on('ubigeo')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_ubigeo_delivery');
    }
}
