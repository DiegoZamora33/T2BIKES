<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Busqueda extends Controller
{
	public function buscar(Request $data)
	{
		if($data->ajax())
		{
			

			if($data['busqueda']){

				$datos['competidores'] = Competidor::where("nombre","like",$data['busqueda']."%")->take(10)->get();
				$dato['entrenadores']= Entrenador::where("nombre","like",$data['busqueda']."%")->take(10)->get();
				$data['competencia'] = Competencia::where("nombreCompetencia","like",$data['busqueda']."%")->take(10)->get();

				if(sizeof($datos['competidores']) > 0 ){
					return view('competidores.front_mostrar_competidor',$datos);

				}
				
				
				
				
				if (sizeof($data['competencia']) > 0 ) {
					return view('competencia.front_mostrar_competencias', $data);
				}
			}
		}
	}
}