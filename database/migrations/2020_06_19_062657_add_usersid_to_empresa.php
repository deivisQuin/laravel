<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersidToEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa', function (Blueprint $table) {
            /*$table->bigInteger("empresaUsersId")->unsigned()->after('empresaFechaModifica');
            $table->foreign('empresaUsersId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');*/

            $table->bigInteger('empresaUsersId')->unsigned();
            $table->foreign('empresaUsersId')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresa', function (Blueprint $table) {
            $table->dropForeign('empresa_empresaUsersId_foreign');
        });
    }
}
