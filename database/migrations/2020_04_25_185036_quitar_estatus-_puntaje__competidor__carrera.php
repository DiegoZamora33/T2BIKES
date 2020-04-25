<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuitarEstatusPuntajeCompetidorCarrera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puntaje__competidor__carreras', function (Blueprint $table) {
            $table->dropColumn('estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puntaje__competidor__carreras', function (Blueprint $table) {
            //
        });
    }
}
