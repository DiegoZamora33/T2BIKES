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
			$data['busqueda'] = str_replace(' ', '', $data['busqueda']);



			if($data['busqueda']){
				$datos['entrenadores'] = DB::select("SELECT * 
												FROM entrenadors 
												WHERE concat(nombre, apellidoPaterno, apellidoMaterno)
												LIKE '%".$data['busqueda']."%' ");

				$dato['competidores'] = DB::select("SELECT *
												FROM competidors 
												WHERE concat(nombre, apellidoPaterno, apellidoMaterno) LIKE '%".$data['busqueda']."%' OR numeroCompetidor LIKE '%".$data['busqueda']."%' ");

				$dat['competencias'] = DB::select("SELECT *
												FROM competencias
												WHERE nombreCompetencia LIKE '%".$data['busqueda']."%' ");


				$final=$dato+$datos+$dat;
				
				return $final;
												
			}

			
		}
	}
}