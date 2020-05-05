<?php

use Illuminate\Database\Seeder;
use App\TipoUsuario;

class tiposUsuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoUsuario = new TipoUsuario();
        $tipoUsuario->tipo = 'Administrador';
        $tipoUsuario->save();

        $tipoUsuario = new TipoUsuario();
        $tipoUsuario->tipo = 'Registro';
        $tipoUsuario->save();

        $tipoUsuario = new TipoUsuario();
        $tipoUsuario->tipo = 'Consulta';
        $tipoUsuario->save();
    }
}
