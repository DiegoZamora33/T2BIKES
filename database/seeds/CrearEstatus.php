<?php

use Illuminate\Database\Seeder;
use App\Estatus;

class crearEstatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estatus = new Estatus();
        $estatus->estatus = 'Terminada';
        $estatus->save();

        $estatus = new Estatus();
        $estatus->estatus = 'En Curso';
        $estatus->save();

        $estatus = new Estatus();
        $estatus->estatus = 'Si Terminó';
        $estatus->save();

        $estatus = new Estatus();
        $estatus->estatus = 'No Terminó';
        $estatus->save();

        $estatus = new Estatus();
        $estatus->estatus = 'Pendiente';
        $estatus->save();
    }
}
