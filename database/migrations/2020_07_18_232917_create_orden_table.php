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
            $table->char("ordenDelivery",1)->default("N");
            $table->string("ordenTelefono",15)->nullable();
            $table->bigInteger("ordenLUId")->nullable();
            $table->longText("ordenComentario")->nullable();
            $table->bigInteger("ordenEstadoId")->unsigned();
            $table->datetime("ordenFechaCrea");
            $table->foreign('ordenEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
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
