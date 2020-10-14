<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaUbigeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_ubigeo', function (Blueprint $table) {
            $table->bigIncrements("EUId");
            $table->bigInteger("EUEmpresaId")->unsigned();
            $table->bigInteger("EUUbigeoId")->unsigned();
            $table->decimal("EUPrecioDelivery", 8, 2);
            $table->foreign('EUEmpresaId')->references('empresaId')->on('empresa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('EUUbigeoId')->references('ubigeoId')->on('ubigeo')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_ubigeo');
    }
}
