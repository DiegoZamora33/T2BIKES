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
				$datos = DB::select("SELECT * 
												FROM entrenadors 
												WHERE concat(nombre, apellidoPaterno, apellidoMaterno)
												LIKE '%".$data['busqueda']."%' ");

				$dato = DB::select("SELECT *
												FROM competidors 
												WHERE concat(nombre, apellidoPaterno, apellidoMaterno) LIKE '%".$data['busqueda']."%' OR numeroCompetidor LIKE '%".$data['busqueda']."%' ");

				$dat = DB::select("SELECT *
												FROM competencias
												WHERE nombreCompetencia LIKE '%".$data['busqueda']."%' ");


				$final=$dato+$datos+$dat;
				
				return view('busqueda.front_mostrar_busqueda', [
																'entrenadores' => $datos,
																'competidores' => $dato,
																'competencias' => $dat, ]);
												
			}

			
		}
	}
}