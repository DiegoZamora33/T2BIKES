<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrenadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrenadors', function (Blueprint $table) {
            $table->bigIncrements('idEntrenador');
            $table->string('nombre',50);
            $table->string('apellidoPaterno',50);
            $table->string('apellidoMaterno',50)->nullable();
            $table->date('fechaRegistro');
            $table->longText('patrocinio')->nullable();
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
        Schema::dropIfExists('entrenadors');
    }
}
