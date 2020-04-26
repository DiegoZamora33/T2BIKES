<?php

namespace App\Http\Controllers;
use App\Competidor;

use Illuminate\Http\Request;

class pruebaAJAX extends Controller
{
    public function competidores(){
        $datos['competidores']=Competidor::paginate(5);
        return view('competidores.front_mostrar_competidor',$datos);
    }
}
