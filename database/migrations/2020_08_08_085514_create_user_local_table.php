<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_local', function (Blueprint $table) {
            $table->id("ULId");
            $table->bigInteger("ULUsersId")->unsigned();
            $table->bigInteger("ULLocalId")->unsigned();
            $table->bigInteger("ULEstadoId")->unsigned();
            $table->foreign('ULUsersId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ULLocalId')->references('localId')->on('local')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ULEstadoId')->references('estadoId')->on('estado')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_local');
    }
}
