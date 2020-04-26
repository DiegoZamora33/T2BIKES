<?php

use Illuminate\Database\Seeder;
use App\Estatus;

class CrearEstatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Estatus de las Competencias
        $estatus = new Estatus();
        $estatus->estatus = 'Activa';
        $estatus->save();

        $estatus = new Estatus();
        $estatus->estatus = 'Finalizada';
        $estatus->save();

        //Estatus de las Carreras
        $estatus = new Estatus();
        $estatus->estatus = 'En Curso';
        $estatus->save();

        $estatus = new Estatus();
        $estatus->estatus = 'Si Termino';
        $estatus->save();

        $estatus = new Estatus();
        $estatus->estatus = 'No Termino';
        $estatus->save();
    }
}
