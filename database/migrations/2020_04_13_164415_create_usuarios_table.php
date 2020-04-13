<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->string('nickname',50);
            $table->primary('nickname');
            $table->string('nombre',50);
            $table->string('apellidoPaterno',50);
            $table->string('apellidoMaterno',50)->nullable();
            $table->string('password',50);
            $table->unsignedBigInteger('idTipoUsuario');
            $table->foreign('idTipoUsuario')->references('idTipoUsuario')->on('tipo_usuarios');
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
        Schema::dropIfExists('usuarios');
    }
}
