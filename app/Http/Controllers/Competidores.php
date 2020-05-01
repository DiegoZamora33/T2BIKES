<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Competidor;

class Competidores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['competidores']=Competidor::all();
        return view('competidores.front_mostrar_competidor',$datos);
    }


    public function estadistica(Request $data)
    {
        if($data->ajax())
        {
            $datos['competidor']=Competidor::where('numeroCompetidor', $data['numeroCompetidor'])->first();

            $datos['entrenador'] = DB::select(" SELECT entrenadors.nombre, entrenadors.apellidoPaterno, entrenadors.apellidoMaterno, mesesEntrenamiento, fechaInicio, fechaFin
                FROM entrenador__competidor__competencias INNER JOIN entrenadors 
                ON entrenador__competidor__competencias.idEntrenador = entrenadors.idEntrenador
                WHERE entrenador__competidor__competencias.numeroCompetidor = '".$data['numeroCompetidor']."' 
                     AND entrenador__competidor__competencias.idCompetencia = '".$data['idCompetencia']."' ");

            $datos['competencia'] = DB::select(" SELECT competencias.idCompetencia, competencias.nombreCompetencia, competencias.periodo, estatuses.estatus, puntaje__competidor__competencias.puntajeGlobal
                    FROM competidors 
                        INNER JOIN puntaje__competidor__competencias INNER JOIN competencias INNER JOIN estatuses
                    ON competidors.numeroCompetidor = puntaje__competidor__competencias.numeroCompetidor 
                        AND competencias.idCompetencia = puntaje__competidor__competencias.idCompetencia
                        AND competencias.idEstatus = estatuses.idEstatus
                        
                    WHERE 
                        puntaje__competidor__competencias.numeroCompetidor = '".$data['numeroCompetidor']."'
                        AND puntaje__competidor__competencias.idCompetencia = '".$data['idCompetencia']."' ");

            $datos['carreras'] = DB::select(" SELECT puntaje__competidor__carreras.idCarrera, puntaje__competidor__carreras.numeroCompetidor, competencias.idCompetencia,
                        carreras.nombreCarrera, carreras.descripcion, tipo_carreras.tipoCarrera, puntaje__competidor__carreras.puntaje, 
                        puntaje__competidor__carreras.lugarLlegada, estatuses.estatus
                    FROM puntaje__competidor__carreras 
                        INNER JOIN carreras INNER JOIN tipo_carreras INNER JOIN competencias INNER JOIN estatuses
                    ON puntaje__competidor__carreras.idCarrera = carreras.idCarrera 
                        AND carreras.idTipoCarrera = tipo_carreras.idTipoCarrera 
                        AND carreras.idCompetencia = competencias.idCompetencia
                        AND estatuses.idEstatus = puntaje__competidor__carreras.idEstatus
                    WHERE puntaje__competidor__carreras.numeroCompetidor = '".$data['numeroCompetidor']."'
                        AND competencias.idCompetencia = '".$data['idCompetencia']."' ");

           

            return view('competidores.front_estadistica_competidor',$datos);
        }
    }


    public function perfilCompetidor(Request $data)
    {
        if($data->ajax())
        {
            $misDatos['competidor']=Competidor::where('numeroCompetidor', $data['numeroCompetidor'])->first();

            $misDatos['competencias'] = DB::select(" SELECT competencias.idCompetencia, competencias.nombreCompetencia, competencias.periodo, estatuses.estatus, puntaje__competidor__competencias.puntajeGlobal
                        FROM competidors 
                            INNER JOIN puntaje__competidor__competencias INNER JOIN competencias INNER JOIN estatuses
                        ON competidors.numeroCompetidor = puntaje__competidor__competencias.numeroCompetidor 
                            AND competencias.idCompetencia = puntaje__competidor__competencias.idCompetencia
                            AND competencias.idEstatus = estatuses.idEstatus
                            
                        WHERE puntaje__competidor__competencias.numeroCompetidor = '".$data['numeroCompetidor']."' ");


            return view('competidores.front_perfil_competidor', $misDatos);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('competidores.front_agregar_competidor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Vemos si es peticion Ajax
        if($request->ajax())
        {
            //Quitamos los 0 a la izquierda del numero de competidor para aguardarlo en la base de datos
            $nuevoNumeroCompetidor = '';
            for ($i=0; $i < strlen($request->numeroCompetidor); $i++) { 
                if ($request->numeroCompetidor[$i] != '0') {
                    $nuevoNumeroCompetidor = substr($request->numeroCompetidor , $i, strlen($request->numeroCompetidor)-$i);
                    break;
                }
            }

            //Verificamos si el numero no es 0 si es asi lanzamos el mensaje
            if ($nuevoNumeroCompetidor != '') {
                //Si se valida el numero de competidor lo registramos en la base de datos
                //Creamos el objeto del nuevo competidor 
                $competidor = new Competidor();
                //Evaluamos si el numero de competidor esta disponible
                if ($competidor->where('numeroCompetidor', $nuevoNumeroCompetidor)->first() == null) {
                    //Si esta disponible aguardamos el nuevo competidor en la base de datos
                    $competidor->numeroCompetidor = $nuevoNumeroCompetidor;
                    $competidor->nombre = trim($request->nombre);
                    $competidor->apellidoPaterno = trim($request->apellidoPaterno);
                    $competidor->apellidoMaterno = trim($request->apellidoMaterno);
                    $competidor->save();
                    //Mansaje de confirmacion
                    return response()->json(['mensaje' => 'creado', 'numeroCompetidor' => $nuevoNumeroCompetidor]);
                }else{
                    //Si el numero de competidor esta ocupado regresamos un mensaje
                    return response()->json(['mensaje' => 'duplicado', 'numeroCompetidor' => $nuevoNumeroCompetidor]);
                }
            } else{
                //Si el numero de competidor es 0 enviamos un mensaje
                return response()->json(['mensaje' => 'numCero']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competidor = Competidor::where('numeroCompetidor', $id)->first();

        return view('competidores.front_editar_competidor',compact('competidor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosCompetidor=request()->except(['_token','_method']);
        Competidor::where('numeroCompetidor','=',$id)->update($datosCompetidor);
        
        $competidor = Competidor::where('numeroCompetidor', $id)->first();
        return view('competidores.front_editar_competidor',compact('competidor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Buscamos al competidor con el id dado y lo eliminamos
        Competidor::where('numeroCompetidor', $id)->delete();
        //Mensaje de confirmacion
        return 'Eliminado';
    }
}
