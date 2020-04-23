<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrenadorCompetidorCompetenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrenador__competidor__competencias', function (Blueprint $table) {
            $table->unsignedBigInteger('idEntrenador');
            $table->string('numeroCompetidor',10);
            $table->unsignedBigInteger('idCompetencia');
            $table->date('fechaInicio')->nullable();
            $table->date('fechaFin')->nullable();
            $table->foreign('idEntrenador')->references('idEntrenador')->on('entrenadors');
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
        Schema::dropIfExists('entrenador__competidor__competencias');
    }
}
