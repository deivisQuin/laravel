<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalsaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salsa', function (Blueprint $table) {
            $table->id("salsaId");
            $table->bigInteger("salsaLocalId")->unsigned();
            $table->string("salsaNombre",100);
            $table->bigInteger("salsaEstadoId")->unsigned();
            $table->bigInteger("salsaUsuarioCrea");
            $table->datetime("salsaFechaCrea");
            $table->bigInteger("salsaUsuarioModifica")->nullable();
            $table->datetime("salsaFechaModifica")->nullable();
            $table->foreign('salsaLocalId')->references('localId')->on('local')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('salsaEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salsa');
    }
}
