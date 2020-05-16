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
			return "Aqui van los Resultados";
		}
	}
}