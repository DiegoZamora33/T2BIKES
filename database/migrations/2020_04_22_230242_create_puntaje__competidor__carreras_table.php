<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntajeCompetidorCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntaje__competidor__carreras', function (Blueprint $table) {
            $table->string('numeroCompetidor',10);
            $table->unsignedBigInteger('idCarrera');
            $table->string('estatus',50)->nullable();
            $table->unsignedBigInteger('lugarLlegada')->nullable();
            $table->float('puntaje', 10, 4);
            $table->foreign('numeroCompetidor')->references('numeroCompetidor')->on('competidors');
            $table->foreign('idCarrera')->references('idCarrera')->on('carreras');
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
        Schema::dropIfExists('puntaje__competidor__carreras');
    }
}
