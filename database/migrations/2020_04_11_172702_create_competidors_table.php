<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competidors', function (Blueprint $table) {
            $table->string('numeroCompetidor',10);
            $table->primary('numeroCompetidor');
            $table->string('nombre',50);
            $table->string('apellidoPaterno',50);
            $table->string('apellidoMaterno',50)->nullable();
            $table->date('fechaRegistro');
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
        Schema::dropIfExists('competidors');
    }
}
