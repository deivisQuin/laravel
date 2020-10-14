<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccion', function (Blueprint $table) {
            $table->id("transaccionId");
            $table->string("transaccionComercioCorreo",80);
            $table->string("transaccionComercioPassword",80);
            $table->string("transaccionComercioPasswordLink",80);
            $table->bigInteger("transaccionComercioEstado");
            $table->datetime("transaccionComercioFechaModifica")->nullable();
            $table->string("transaccionClienteCorreo",80);
            $table->string("transaccionClientePassword",80);
            $table->string("transaccionClientePasswordLink",80);
            $table->bigInteger("transaccionClienteEstado");
            $table->datetime("transaccionClienteFechaModifica")->nullable();
            $table->decimal("transaccionMonto", 8, 2);
            $table->longText("transaccionDescripcion");
            $table->bigInteger("transaccionEstadoId")->unsigned();
            $table->integer("transaccionUsuarioCrea");
            $table->datetime("transaccionFechaCrea");
            $table->string("transaccionPasarelaPedidoId", 100);
            $table->string("transaccionPasarelaToken", 100);
            $table->string("transaccionPasarelaMonedaCodigo", 5);
            $table->string("transaccionPasarelaBancoNombre", 100);
            $table->string("transaccionPasarelaBancoPaisNombre", 100);
            $table->string("transaccionPasarelaBancoPaisCodigo", 100);
            $table->string("transaccionPasarelaTarjetaMarca", 100);
            $table->string("transaccionPasarelaTarjetaTipo", 100);
            $table->string("transaccionPasarelaTarjetaCategoria", 100);
            $table->string("transaccionPasarelaTarjetaNumero", 100);
            $table->string("transaccionPasarelaDispositivoIp", 100);
            $table->string("transaccionPasarelaCodigoAutorizacion", 100);
            $table->string("transaccionPasarelaCodigoReferencia", 100);
            $table->string("transaccionPasarelaCodigoRespuesta", 100);
            $table->decimal("transaccionPasarelaComision", 8, 2);
            $table->decimal("transaccionPasarelaIgv", 8, 2);
            $table->decimal("transaccionPasarelaComisionFija", 8, 2);
            $table->decimal("transaccionPasarelaComisionFijaIgv", 8, 2);
            $table->decimal("transaccionPasarelaMontoDepositar", 8, 2);
            $table->decimal("transaccionComisionComercio", 8, 2);
            $table->decimal("transaccionComercioMontoDepositar", 8, 2);
            $table->bigInteger("transaccionEmpresaId")->unsigned();
            $table->bigInteger("transaccionOrdenId")->unsigned();
            $table->foreign('transaccionEmpresaId')->references('empresaId')->on('empresa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transaccionOrdenId')->references('ordenId')->on('orden')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transaccionEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaccion');
    }
}
