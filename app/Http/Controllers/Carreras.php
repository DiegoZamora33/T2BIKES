<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrera;
use App\Competencia;
use App\TipoCarrera;
use App\Puntaje_Competidor_Carrera;
use Illuminate\Support\Facades\DB;

class Carreras extends Controller
{

    public function index()
    {
        //Extraemos todas las carreras
        $datosCarreras = Carrera::all();

        //Creamos un arreglo para los nuevos datos
        $carreras = array();

        //Recorremos cada carrera y ponemos su informacion en un nuevo arreglo pero ahora con los nombre del tipo y competencia
        foreach ($datosCarreras as $datosCarrera) {
            $carrera = array();
            $carrera['idCarrera'] = $datosCarrera->idCarrera;
            $carrera['nombre'] = $datosCarrera->nombreCarrera;
            $carrera['descripcion'] = $datosCarrera->descripcion;
            $carrera['tipo'] = $datosCarrera->tipoCarrera()->first()->tipoCarrera;
            $carrera['competencia'] = $datosCarrera->competencia()->first()->nombreCompetencia;

            $carreras[] = $carrera; //Ponemos el arreglo de una carrera en el arreglo de todas las carreras
        }
        //Enviamos la informacion de las carreras a la vista
        return view('carreras.front_mostrar_carreras', compact('carreras'));
    }


    public function datosPuntajeCarrera(Request $data)
    {
        if ($data->ajax()) 
        {
            // Buscamos en la base de datos
            $puntaje = Puntaje_Competidor_Carrera::where('idCarrera', '=', $data['idCarrera'])->where('numeroCompetidor', '=', $data['numeroCompetidor'])->first();

            // Retornamos los datos en un JSON
           return response()->json(['numeroCompetidor' => $puntaje->numeroCompetidor, 'puntaje' => $puntaje->puntaje, 'status' => $puntaje->idEstatus, 'lugar' => $puntaje->lugarLlegada]);
        }
    }


    public function perfilCarrera(Request $data)
    {
        if($data->ajax())
        {
            // Bucamos todos los datos necesarios
            $datos['competencia'] = Competencia::where('idCompetencia', '=', $data['idCompetencia'])->first();

            $datos['carrera'] = DB::select(" SELECT carreras.idCarrera, carreras.nombreCarrera, carreras.descripcion, carreras.created_at, tipo_carreras.tipoCarrera
                FROM carreras  INNER JOIN tipo_carreras
                ON  carreras.idTipoCarrera = tipo_carreras.idTipoCarrera
                WHERE carreras.idCarrera = ".$data['idCarrera']." 
                    AND carreras.idCompetencia = ".$data['idCompetencia']." ");

            $datos['participantes'] = DB::select(" SELECT competidors.numeroCompetidor, competidors.nombre, competidors.apellidoPaterno, competidors.apellidoMaterno,
                    puntaje__competidor__carreras.lugarLlegada, puntaje__competidor__carreras.puntaje, estatuses.estatus
                FROM carreras INNER JOIN puntaje__competidor__carreras INNER JOIN competencias INNER JOIN competidors INNER JOIN estatuses
                ON carreras.idCarrera = puntaje__competidor__carreras.idCarrera 
                    AND carreras.idCompetencia = competencias.idCompetencia
                    AND competidors.numeroCompetidor = puntaje__competidor__carreras.numeroCompetidor
                    AND estatuses.idEstatus = puntaje__competidor__carreras.idEstatus
                WHERE carreras.idCarrera = ".$data['idCarrera']."
                    AND competencias.idCompetencia = ".$data['idCompetencia']." ORDER BY puntaje__competidor__carreras.lugarLlegada ASC ");


            return view('carreras.front_perfil_carrera', $datos);
        }
    }

    public function create()
    {
        //Extraemos los datos de las competencias y tipos de carrera
        $competencias = Competencia::all('idCompetencia', 'nombreCompetencia');
        $tiposCarrera = TipoCarrera::all('idtipoCarrera', 'tipoCarrera');
       
        //Regresamos la vista para registrar una carrera
        return view('carreras.front_agregar_carrera', compact('competencias', 'tiposCarrera'));
    }


    public function store(Request $request)
    {
        //Creamos un nuevo registro en la base de datos
        Carrera::create($request->all());
        //Nos redireccionamos al index
        return redirect()->route('carreras.index');
    }


    public function show($id)
    {
        //Extraemos la informacion de la base de datos de la carrera deseada
        $carrera = Carrera::where('idCarrera', $id)->first();
        
        //Creamos un arreglo para los datos a mostrar y agregamos los datos
        $datos = array();
        $datos['nombre'] = $carrera->nombreCarrera;
        $datos['descripcion'] = $carrera->descripcion;
        $datos['tipo'] = $carrera->tipoCarrera()->first()->tipoCarrera;
        $datos['competencia'] = $carrera->competencia()->first()->nombreCompetencia;
        
        //Mostramos la vista y mandamos la informacion
        return view('carreras.front_mostrar_Carrera', compact('datos'));
    }


    public function edit($id)
    {
        //Extraemos los datos de las competencias y tipos de carrera
        $competencias = Competencia::all('idCompetencia', 'nombreCompetencia');
        $tiposCarrera = TipoCarrera::all('idtipoCarrera', 'tipoCarrera');
        
        //Extraemos la informacion de la base de datos de la carrera deseada
        $carrera = Carrera::where('idCarrera', $id)->first();

        //Mostramos la vista y mandamos la informacion
        return view('carreras.front_editar_carrera', compact('competencias', 'tiposCarrera', 'carrera'));
    }


    public function update(Request $request, $id)
    {
        //Quitamos los datos no deseados del request
        $nuevosDatos=request()->except(['_token','_method']);

        //Actualizamos los campos de la bd con los nuevos datos
        Carrera::where('idCarrera', $id)->update($nuevosDatos);

        //Nos redireccionamos al index
        return redirect()->route('carreras.index');
    }


    public function destroy($id)
    {
        //Buscamos y eliminamos el registro de la bd con el id
        Carrera::where('idCarrera', $id)->delete();
        //Regresamos al indice
        return redirect()->route('carreras.index');
    }
}
