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
            $table->string("transaccionClienteCorreo",80);
            $table->string("transaccionClientePassword",80);
            $table->string("transaccionClientePasswordLink",80);
            $table->decimal("transaccionMonto", 8, 2);
            $table->string("transaccionDescripcion",250);
            $table->bigInteger("transaccionEstado");
            $table->integer("transaccionUsuarioCrea");
            $table->datetime("transaccionFechaCrea");
            $table->bigInteger("transaccionComercioEstado");
            $table->datetime("transaccionComercioFechaModifica")->nullable();
            $table->bigInteger("transaccionClienteEstado");
            $table->datetime("transaccionClienteFechaModifica")->nullable();

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
        Schema::dropIfExists('transaccion');
    }
}
