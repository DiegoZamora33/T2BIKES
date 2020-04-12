<?php

use Illuminate\Database\Seeder;

class crear_competidores extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competidors')->insert([
        	'numeroCompetidor' => '1',
        	'nombre' => 'Prueba',
        	'apellidoPaterno' => 'Competidor',
        	'apellidoMaterno' => '01',
        	'fechaRegistro' => date('Y-m-d'),
        ]);

        DB::table('competidors')->insert([
        	'numeroCompetidor' => '2',
        	'nombre' => 'Prueba',
        	'apellidoPaterno' => 'Competidor 02',
        	'apellidoMaterno' => '',
        	'fechaRegistro' => date('Y-m-d'),
        ]);

        DB::table('competidors')->insert([
        	'numeroCompetidor' => '3',
        	'nombre' => 'Prueba',
        	'apellidoPaterno' => 'Competidor',
        	'apellidoMaterno' => '03',
        	'fechaRegistro' => date('Y-m-d'),
        ]);
    }
}
