<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->bigIncrements("ordenId");
            $table->char("ordenDelivery",1)->nullable();
            $table->string("ordenTelefono",15);
            $table->bigInteger("ordenEstadoId")->unsigned();
            $table->bigInteger("ordenTransaccionId")->unsigned();
            $table->foreign('ordenEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ordenTransaccionId')->references('transaccionId')->on('transaccion')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('orden');
    }
}
