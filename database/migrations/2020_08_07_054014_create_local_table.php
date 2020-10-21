<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local', function (Blueprint $table) {
            $table->id("localId");
            $table->bigInteger("localEmpresaId")->unsigned();
            $table->string("localNombre",100);
            $table->string("localEmail",100);
            $table->time("localHoraApertura",0);
            $table->time("localHoraCierre",0);
            $table->bigInteger("localEstadoId")->unsigned();
            $table->string("localTelefono",20)->nullable();
            $table->string("localDireccion",100)->nullable();
            $table->string("localRepresentante",50)->nullable();
            $table->bigInteger("localUbigeoId")->unsigned();
            $table->bigInteger("localUsuarioCrea");
            $table->datetime("localFechaCrea");
            $table->bigInteger("localUsuarioModifica")->nullable();
            $table->datetime("localFechaModifica")->nullable();
            $table->foreign('localEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('localEmpresaId')->references('empresaId')->on('empresa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('localUbigeoId')->references('ubigeoId')->on('ubigeo')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local');
    }
}
