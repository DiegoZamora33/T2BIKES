<?php

use Illuminate\Database\Seeder;
use App\TipoCarrera;

class tiposCarrera extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoCarrera = new TipoCarrera();
        $tipoCarrera->tipoCarrera = 'Montaña';
        $tipoCarrera->save();

        $tipoCarrera = new TipoCarrera();
        $tipoCarrera->tipoCarrera = 'Velocidad';
        $tipoCarrera->save();

        $tipoCarrera = new TipoCarrera();
        $tipoCarrera->tipoCarrera = 'Terraceria';
        $tipoCarrera->save();
    }
}
