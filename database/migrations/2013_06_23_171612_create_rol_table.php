<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->id("rolId");
            $table->string("rolNombreCorto",10);
            $table->string("rolNombre",20);
            $table->string("rolObservacion",50);
            $table->bigInteger("rolEstadoId")->unsigned();
            $table->foreign('rolEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol');
    }
}
