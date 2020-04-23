<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->bigIncrements('idCarrera');
            $table->string('nombreCarrera',50);
            $table->longText('descripcion')->nullable();
            $table->unsignedBigInteger('idCompetencia');
            $table->unsignedBigInteger('idTipoCarrera');
            $table->foreign('idCompetencia')->references('idCompetencia')->on('competencias');
            $table->foreign('idTipoCarrera')->references('idTipoCarrera')->on('tipo_carreras');
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
        Schema::dropIfExists('carreras');
    }
}
