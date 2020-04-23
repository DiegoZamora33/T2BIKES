<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntajeCompetidorCompetenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntaje__competidor__competencias', function (Blueprint $table) {
            $table->string('numeroCompetidor',10);
            $table->unsignedBigInteger('idCompetencia');
            $table->float('puntajeGlobal', 10, 4);
            $table->foreign('numeroCompetidor')->references('numeroCompetidor')->on('competidors');
            $table->foreign('idCompetencia')->references('idCompetencia')->on('competencias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puntaje__competidor__competencias');
    }
}
