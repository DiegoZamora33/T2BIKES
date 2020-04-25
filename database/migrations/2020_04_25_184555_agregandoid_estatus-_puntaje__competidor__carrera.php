<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregandoidEstatusPuntajeCompetidorCarrera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puntaje__competidor__carreras', function (Blueprint $table) {
            $table->unsignedBigInteger('idEstatus');
            $table->foreign('idEstatus')->references('idEstatus')->on('estatuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estatuses', function (Blueprint $table) {
            //
        });
    }
}
