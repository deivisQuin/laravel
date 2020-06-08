<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id("empresaId");
            $table->string("empresaNombre",100);
            $table->string("empresaEmail",100);
            $table->string("empresaRuc",80);
            $table->string("empresaRazonSocial",100);
            $table->string("empresaNombreComecial",100);
            $table->string("empresaNumeroCuenta",80);
            $table->string("empresaTelefono",20)->nullable();
            $table->string("empresaDireccion",100)->nullable();
            $table->string("empresaRepresentante",50)->nullable();
            $table->bigInteger("empresaEstadoId")->unsigned();
            $table->bigInteger("empresaUsuarioCrea");
            $table->datetime("empresaFechaCrea");
            $table->bigInteger("empresaUsuarioModifica")->nullable();
            $table->datetime("empresaFechaModifica")->nullable();
            $table->foreign('empresaEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
