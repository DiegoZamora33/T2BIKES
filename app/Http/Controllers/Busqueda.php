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
				$datos['entrenadores'] = DB::select("SELECT * 
												FROM entrenadors 
												WHERE concat(nombre, ' ', apellidoPaterno)
												LIKE '%".$data['busqueda']."%' ");

				$datos['competidores'] = DB::select("SELECT *
												FROM competidors 
												WHERE concat(nombre, ' ', apellidoPaterno) LIKE '%".$data['busqueda']."%' OR numeroCompetidor LIKE '%".$data['busqueda']."%' ");

				$datos['competencias'] = DB::select("SELECT *
												FROM competencias
												WHERE nombreCompetencia LIKE '%".$data['busqueda']."%' ");




				 return view('busqueda.front_mostrar_busqueda',$datos);
		}
	}
}