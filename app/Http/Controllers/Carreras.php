<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrera;
use App\Competencia;
use App\TipoCarrera;
use App\Puntaje_Competidor_Carrera;
use App\Puntaje_Competidor_Competencia;
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

            $datos['carrera'] = DB::select(" SELECT carreras.idCarrera, carreras.nombreCarrera, carreras.descripcion, carreras.created_at, carreras.idTipoCarrera, tipo_carreras.tipoCarrera
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

            $datos['numParticipantes'] = DB::select("SELECT COUNT(*) inscritos FROM competencias
                   INNER JOIN puntaje__competidor__competencias
                    ON competencias.idCompetencia = puntaje__competidor__competencias.idCompetencia
                    WHERE puntaje__competidor__competencias.idCompetencia = ".$data['idCompetencia']."");


            $datos['tiposCarreras'] = TipoCarrera::all();


            return view('carreras.front_perfil_carrera', $datos);
        }
    }


    public function statDinamic(Request $data)
    {
        if($data->ajax())
        {
             $datos['participantes'] = DB::select(" SELECT competidors.numeroCompetidor, competidors.nombre, competidors.apellidoPaterno, competidors.apellidoMaterno,
                    puntaje__competidor__carreras.lugarLlegada, puntaje__competidor__carreras.puntaje, estatuses.estatus
                FROM carreras INNER JOIN puntaje__competidor__carreras INNER JOIN competencias INNER JOIN competidors INNER JOIN estatuses
                ON carreras.idCarrera = puntaje__competidor__carreras.idCarrera 
                    AND carreras.idCompetencia = competencias.idCompetencia
                    AND competidors.numeroCompetidor = puntaje__competidor__carreras.numeroCompetidor
                    AND estatuses.idEstatus = puntaje__competidor__carreras.idEstatus
                WHERE carreras.idCarrera = ".$data['idCarrera']."
                    AND competencias.idCompetencia = ".$data['idCompetencia']." ORDER BY puntaje__competidor__carreras.lugarLlegada ASC LIMIT ".$data['numero']." ");

            return view('carreras.front_estadistica_carrera', $datos);
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
        //Verificamos que haya elegido un tipo
        if ($request->idTipoCarrera != 0) {
            //Creamos un nuevo registro en la base de datos
            Carrera::create($request->all());
            $idCarrera = Carrera::where('nombreCarrera', $request->nombreCarrera)->first()->idCarrera;

            //Creamos las relaciones con los competidores ya registrados
            $competidores = DB::select("SELECT puntaje__competidor__competencias.numeroCompetidor FROM puntaje__competidor__competencias 
                                        WHERE puntaje__competidor__competencias.idCompetencia = '".$request->idCompetencia."'");
            foreach ($competidores as $competidor){
                $nuevaPuntajeCarrera = new Puntaje_Competidor_Carrera();
                $nuevaPuntajeCarrera->numeroCompetidor = $competidor->numeroCompetidor;
                $nuevaPuntajeCarrera->idCarrera = $idCarrera;
                $nuevaPuntajeCarrera->lugarLlegada = 0;
                $nuevaPuntajeCarrera->puntaje = 0;
                $nuevaPuntajeCarrera->idEstatus = 5;
                $nuevaPuntajeCarrera->save();
            }
            
            return response()->json(['codigo' => 'Registrado', 'mensaje' => 'La carrera '.$request->nombreCarrera.' a sido registrada con exito']);
        }
        //Mensaje de advertencia
        return response()->json(['codigo' => 'SinTipo', 'mensaje' => 'Eliga un tipo de carrera']);
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
        //Actualizamos los campos de la bd con los nuevos datos
        Carrera::where('idCarrera', $id)->update(request()->except(['_token','_method']));

        //Mensaje de confirmacion
        return response()->json(['codigo' => 'Actualizado', 'mensaje' => 'La competencia '.$request->nombreCarrera.' a sido editada satisfactoriamente']);
    }


    public function destroy($id)
    {
        //Extraemos el nombre de la carrera
        $nombreCarrera = Carrera::where('idCarrera', $id)->first()->nombreCarrera;

        //Extraemos los puntajes de las carreras y sus competidores
        $competidores = DB::select("SELECT numeroCompetidor, puntaje  FROM puntaje__competidor__carreras 
                                        WHERE idCarrera = '".$id."'");
        //Restamos los puntaje de la carrera
        foreach ($competidores as $competidor) {
            $puntajeGlobal = Puntaje_Competidor_Competencia::where('numeroCompetidor', $competidor->numeroCompetidor)->first()->puntajeGlobal;
            $nuevoPuntaje = floatval($puntajeGlobal) -  floatval($competidor->puntaje);
            Puntaje_Competidor_Competencia::where('numeroCompetidor', $competidor->numeroCompetidor)->update(['puntajeGlobal'=>$nuevoPuntaje]);
        }

        //Eliminamos la carrera de la base de datos
        Puntaje_Competidor_Carrera::where('idCarrera', $id)->delete();
        Carrera::where('idCarrera', $id)->delete();

        //Mensaje de confirmcion
        return response()->json(['codigo' => 'Actualizado', 'mensaje' => 'La carrera '.$nombreCarrera.' a sido eliminado exitosamente']);
    }
}
