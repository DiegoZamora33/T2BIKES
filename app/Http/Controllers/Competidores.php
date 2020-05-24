<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Competidor;
use App\Competencia;
use App\Entrenador;
use App\Entrenador_Competidor_Competencia;
use App\Puntaje_Competidor_Competencia;
use App\Puntaje_Competidor_Carrera;
use Carbon\Carbon;

class Competidores extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['competidores']=Competidor::orderBy('created_at', 'DESC')->get();
        return view('competidores.front_mostrar_competidor',$datos);
        
    }


    public function asignarEntrenador(Request $data)
    {
        if ($data->ajax()) 
        {
            // Nos fijamos que que el id no sea cero
            if ($data['idEntrenador'] != '0') 
            {
                $nuevoEntrenamiento = new Entrenador_Competidor_Competencia();
                $nuevoEntrenamiento->idEntrenador = $data['idEntrenador'];
                $nuevoEntrenamiento->numeroCompetidor = $data['numeroCompetidor'];
                $nuevoEntrenamiento->idCompetencia = $data['idCompetencia'];

                 /// Proceso Para Calculo de Fechas
                $fecha = date('Y-m-j');
                $nuevafecha = strtotime ( '+'.$data['mesesEntrenamiento'].' month' , strtotime ( $fecha ) ) ;
                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                
                $nuevoEntrenamiento->fechaInicio = $fecha;
                $nuevoEntrenamiento->fechaFin = $nuevafecha;
                $nuevoEntrenamiento->mesesEntrenamiento = $data['mesesEntrenamiento'];
                $nuevoEntrenamiento->save();

                // Mensaje de exito
                return response()->json(['mensaje' => 'Se Agregó el Entrenador con exito...']);
            }
            else
            {
                // Mensaje de exito
                 return response()->json(['mensaje' => 'No se Asignó un Entrenador, todo sigue igual...']);
            }

        }
    }

    public function quitarEntrenador(Request $data)
    {
        //Buscamos el registro y lo eliminamos
        DB::delete("delete from entrenador__competidor__competencias where numeroCompetidor = ".$data['numeroCompetidor'].              " AND idEntrenador = ".$data['idEntrenador']." AND idCompetencia = ".$data['idCompetencia']."");

        // Mensaje de exito
        return response()->json(['codigo' => 'update', 'mensaje' => 'Se ha quitado el Entrendor...']);
    }


    public function asignarPuntajeCarrera(Request $data)
    {
        if ($data->ajax()) 
        {
            $puntaje = $data->except('idCompetencia');

            // Buscamos y hacemos el update en la carrera
            Puntaje_Competidor_Carrera::where('numeroCompetidor','=',$data['numeroCompetidor'])->where('idCarrera', '=', $data['idCarrera'])->update($puntaje);

            //Sacamos mi valor de sumatoria de todas las carreras en la competencia
            $global = DB::select(" SELECT SUM(puntaje__competidor__carreras.puntaje) AS total
                    FROM puntaje__competidor__carreras 
                    INNER JOIN carreras INNER JOIN tipo_carreras INNER JOIN competencias INNER JOIN estatuses
                    ON puntaje__competidor__carreras.idCarrera = carreras.idCarrera 
                        AND carreras.idTipoCarrera = tipo_carreras.idTipoCarrera 
                        AND carreras.idCompetencia = competencias.idCompetencia
                        AND estatuses.idEstatus = puntaje__competidor__carreras.idEstatus
                    WHERE puntaje__competidor__carreras.numeroCompetidor = ".$data['numeroCompetidor']."
                        AND competencias.idCompetencia = ".$data['idCompetencia']." ");

            //Actualizamos el Puntaje Global
            foreach ($global as &$miGlobal) 
            {
                $affectwed = DB::update("update puntaje__competidor__competencias                              set puntajeGlobal = ".$miGlobal->total." where numeroCompetidor = ".$data['numeroCompetidor']." AND idCompetencia = ".$data['idCompetencia']." ");
                break;
            }

            // Mensaje de exito
              return response()->json(['codigo' => 'update', 'mensaje' => 'Actualizacion de datos con exito...']);
        }
    }


    public function datosPuntajeCarrera(Request $data)
    {
        if ($data->ajax()) 
        {
            // Buscamos en la base de datos
            $puntaje = Puntaje_Competidor_Carrera::where('idCarrera', '=', $data['idCarrera'])->where('numeroCompetidor', '=', $data['numeroCompetidor'])->first();

            // Retornamos los datos en un JSON
           return response()->json(['idCarrera' => $puntaje->idCarrera, 'puntaje' => $puntaje->puntaje, 'status' => $puntaje->idEstatus, 'lugar' => $puntaje->lugarLlegada]);
        }
    }


    public function asignarCompetencia(Request $data)
    {
        if($data->ajax())
        {

            $queryCheck = DB::select(" SELECT * FROM competidors WHERE numeroCompetidor = ".$data['numeroCompetidor']." ");

            if($queryCheck != null)
            {

                    // Verificamos que Si esta Seleccionando Algo
                    if ($data['competencia'] != '0' && $data['entrenador'] != '0') 
                    {
                        // Vamos a Valdidar que no se repita en la tabla Entrenador_Competidor_Competencia
                        $queryEntrenamiento = DB::select(" SELECT * FROM entrenador__competidor__competencias
                                                            WHERE idEntrenador = '".$data['entrenador']."'
                                                                AND numeroCompetidor = '".$data['numeroCompetidor']."'
                                                                AND idCompetencia = '".$data['competencia']."' ");

                        $queryPuntajeCompetencia = DB::select(" SELECT * FROM puntaje__competidor__competencias
                                                            WHERE numeroCompetidor = '".$data['numeroCompetidor']."'
                                                                AND idCompetencia = '".$data['competencia']."' ");


                        if($queryEntrenamiento == null && $queryPuntajeCompetencia == null)
                        {
                            // Creamos el Registro en la tabla de Entrenador_Competidor_Competencias
                            $nuevoEntrenamiento = new Entrenador_Competidor_Competencia();
                            $nuevoEntrenamiento->idEntrenador = $data['entrenador'];
                            $nuevoEntrenamiento->numeroCompetidor = $data['numeroCompetidor'];
                            $nuevoEntrenamiento->idCompetencia = $data['competencia'];

                            /// Proceso Para Calculo de Fechas
                            $fecha = date('Y-m-j');
                            $nuevafecha = strtotime ( '+'.$data['mesesEntrenamiento'].' month' , strtotime ( $fecha ) ) ;
                            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                            
                            $nuevoEntrenamiento->fechaInicio = $fecha;
                            $nuevoEntrenamiento->fechaFin = $nuevafecha;
                            $nuevoEntrenamiento->mesesEntrenamiento = $data['mesesEntrenamiento'];
                            $nuevoEntrenamiento->save();

                            // Asignacion en la tabla de Puntaje_Competidor_Competencia
                            $nuevaPuntajeCompetencia = new Puntaje_Competidor_Competencia();
                            $nuevaPuntajeCompetencia->numeroCompetidor = $data['numeroCompetidor'];
                            $nuevaPuntajeCompetencia->idCompetencia = $data['competencia'];
                            $nuevaPuntajeCompetencia->puntajeGlobal = 0;
                            $nuevaPuntajeCompetencia->save();

                            // Vamos a crear los Registros de las Carreras Correspondientes
                            $misCarreras = DB::select(" SELECT carreras.idCarrera FROM carreras INNER JOIN competencias     INNER JOIN tipo_carreras
                                ON carreras.idCompetencia = competencias.idCompetencia
                                    AND carreras.idTipoCarrera = tipo_carreras.idTipoCarrera
                                WHERE competencias.idCompetencia = '".$data['competencia']."'");

                            foreach ($misCarreras as &$carrera) 
                            {
                                $nuevaPuntajeCarrera = new Puntaje_Competidor_Carrera();
                                $nuevaPuntajeCarrera->numeroCompetidor = $data['numeroCompetidor'];
                                $nuevaPuntajeCarrera->idCarrera = $carrera->idCarrera;
                                $nuevaPuntajeCarrera->lugarLlegada = 0;
                                $nuevaPuntajeCarrera->puntaje = 0;
                                $nuevaPuntajeCarrera->idEstatus = 5;
                                $nuevaPuntajeCarrera->save();
                            }

                            // Mendaje de Exito
                            return response()->json(['codigo' => 'creado', 'mensaje' => 'Competencia y Entrenador asignados con exito...']);
                        }
                        else
                        {
                            // Ya existe en la tabla Entrenador_Competidor_Competencias y en la Tabla Puntaje_Competidor_Competencias
                            // Solo falta saber si esta siendo entrenado.
                                $queryEntrenamiento = DB::select(" SELECT * FROM entrenador__competidor__competencias
                                                            WHERE numeroCompetidor = '".$data['numeroCompetidor']."'
                                                                  AND idCompetencia = '".$data['competencia']."' ");

                                if($queryEntrenamiento == null)
                                {
                                    // Ya existe en tabla Puntaje_Competidor_Competencias y en la tabla Entrenador_Competidor_Competencias
                                    return response()->json(['codigo' => 'duplicadoFaltaEntrenador', 'mensaje' => 'Este Competidor ya esta dentro de la Competencia, solo le falta el Entrenador, puede asignarlo en el apartado del perfil del competidor.']);
                                }
                                else
                                {
                                    // Ya existe en la tabla Entrenador_Competidor_Competencias y en la Tabla Puntaje_Competidor_Competencias
                                    return response()->json(['codigo' => 'duplicado', 'mensaje' => 'Este Competidor ya esta dentro de la Competencia y ya tiene a un Entrenador asignado']);
                                }
                        }
                    }
                    else
                    {
                        //Vemos si solo Selecciono una Competencia pero ningun Entrenador
                        if ($data['competencia'] != '0' && $data['entrenador'] == '0') 
                        {
                            //Validamos que no se repita en la tabla Puntaje_Competidor_Competencias
                            $queryPuntajeCompetencia = DB::select(" SELECT * FROM puntaje__competidor__competencias
                                                            WHERE numeroCompetidor = '".$data['numeroCompetidor']."'
                                                                AND idCompetencia = '".$data['competencia']."' ");

                            if($queryPuntajeCompetencia == null)
                            {
                                 // Asignacion en la tabla de Puntaje_Competidor_Competencia
                                $nuevaPuntajeCompetencia = new Puntaje_Competidor_Competencia();
                                $nuevaPuntajeCompetencia->numeroCompetidor = $data['numeroCompetidor'];
                                $nuevaPuntajeCompetencia->idCompetencia = $data['competencia'];
                                $nuevaPuntajeCompetencia->puntajeGlobal = 0;
                                $nuevaPuntajeCompetencia->save();

                                // Vamos a crear los Registros de las Carreras Correspondientes
                                $misCarreras = DB::select(" SELECT carreras.idCarrera FROM carreras INNER JOIN competencias     INNER JOIN tipo_carreras
                                    ON carreras.idCompetencia = competencias.idCompetencia
                                        AND carreras.idTipoCarrera = tipo_carreras.idTipoCarrera
                                    WHERE competencias.idCompetencia = '".$data['competencia']."'");

                                foreach ($misCarreras as &$carrera) 
                                {
                                    $nuevaPuntajeCarrera = new Puntaje_Competidor_Carrera();
                                    $nuevaPuntajeCarrera->numeroCompetidor = $data['numeroCompetidor'];
                                    $nuevaPuntajeCarrera->idCarrera = $carrera->idCarrera;
                                    $nuevaPuntajeCarrera->lugarLlegada = 0;
                                    $nuevaPuntajeCarrera->puntaje = 0;
                                    $nuevaPuntajeCarrera->idEstatus = 5;
                                    $nuevaPuntajeCarrera->save();
                                }

                                // Mendaje de Exito
                                return response()->json(['codigo' => 'creadoSinEntrenador', 'mensaje' => 'Competencia asignada con exito, NO se asignó ningun Entrenador...']);
                            }
                            else
                            {
                                // Ya existe en la Tabla Puntaje_Competidor_Competencias osea ya esta dentro de la competencia
                                // Solo falta saber si esta siendo entrenado.
                                $queryEntrenamiento = DB::select(" SELECT * FROM entrenador__competidor__competencias
                                                            WHERE numeroCompetidor = '".$data['numeroCompetidor']."'
                                                                  AND idCompetencia = '".$data['competencia']."' ");

                                if($queryEntrenamiento == null)
                                {
                                    // Ya existe en tabla Puntaje_Competidor_Competencias y en la tabla Entrenador_Competidor_Competencias
                                    return response()->json(['codigo' => 'duplicadoFaltaEntrenador', 'mensaje' => 'Este Competidor ya esta dentro de la Competencia, solo le falta el Entrenador, puede asignarlo en el apartado del perfil del competidor.']);
                                }
                                else
                                {
                                    // Ya existe en la tabla Entrenador_Competidor_Competencias y en la Tabla Puntaje_Competidor_Competencias
                                    return response()->json(['codigo' => 'duplicado', 'mensaje' => 'Este Competidor ya esta dentro de la Competencia y ya tiene a un Entrenador asignado']);
                                }
                            }
                        }
                        else
                        {
                            // Quisa no ha seleccionado nada o solo selecciono a un Entrenador
                            return response()->json(['codigo' => 'nadaSeleccionado', 'mensaje' => 'Primero debes elegir una Competencia']);
                        }
                    }
            }
            else
            {
                // No hay competidor Seleccionado
                 return response()->json(['codigo' => 'nadaSeleccionado', 'mensaje' => 'Este Numero de Competidor no existe']);
            }
        }
    }

    
    public function quitarCompetencia(Request $data)
    {
        if($data->ajax())
        {
             // Buscamos haber si existe
            $queryCheck = DB::select(" SELECT * FROM competidors WHERE numeroCompetidor = ".$data['numeroCompetidor']." ");
            if($queryCheck != null)
            {
                $queryCheck2 = DB::select(" SELECT * FROM puntaje__competidor__competencias WHERE
                                        numeroCompetidor = ".$data['numeroCompetidor']." AND 
                                        idCompetencia = ".$data['idCompetencia']." ");
                if($queryCheck2 != null)
                {
                        // Buscamos los registros de la competencia y la relacin con este competidor y los eliminamos
                         $affected = DB::delete(" DELETE FROM entrenador__competidor__competencias 
                                            WHERE
                                              numeroCompetidor = ".$data['numeroCompetidor']."  AND 
                                              idCompetencia = ".$data['idCompetencia']." ");


                        // Buscamos todas las carreras de la competencia a quitar
                        $carres = DB::select(" SELECT carreras.idCarrera FROM carreras INNER JOIN competencias     INNER JOIN tipo_carreras
                            ON carreras.idCompetencia = competencias.idCompetencia
                                AND carreras.idTipoCarrera = tipo_carreras.idTipoCarrera
                            WHERE competencias.idCompetencia = ".$data['idCompetencia']." ");


                        foreach($carres as &$miCarrers) 
                        {
                            $affected = DB::delete(" DELETE FROM puntaje__competidor__carreras
                                    WHERE
                                    numeroCompetidor = ".$data['numeroCompetidor']." AND 
                                    idCarrera = ".$miCarrers->idCarrera." ");
                        }


                        // Borramos el registro de Carrera Competidor

                        $affected = DB::delete(" DELETE FROM puntaje__competidor__competencias
                                        WHERE
                                        numeroCompetidor = ".$data['numeroCompetidor']." AND 
                                        idCompetencia = ".$data['idCompetencia']." ");

                        return response()->json(['codigo' => 'quitado', 'mensaje' => "Se ha quitado al competidor (".$data['numeroCompetidor'].") la competencia..."]);
                }
                else
                {
                    // No Existe
                 return response()->json(['codigo' => 'nadaSeleccionado', 'mensaje' => "El Numero de Competidor (".$data['numeroCompetidor'].") no esta en esta Competencia"]);
                }
             }
            else
            {
                // No Existe
                 return response()->json(['codigo' => 'nadaSeleccionado', 'mensaje' => "El Numero de Competidor (".$data['numeroCompetidor'].") no existe"]);
            }
        }
    }

    public function estadistica(Request $data)
    {
        if($data->ajax())
        {
            $datos['competidor']=Competidor::where('numeroCompetidor', $data['numeroCompetidor'])->first();

            $datos['entrenador'] = DB::select(" SELECT entrenadors.idEntrenador, entrenadors.nombre, entrenadors.apellidoPaterno, entrenadors.apellidoMaterno, mesesEntrenamiento, fechaInicio, fechaFin
                FROM entrenador__competidor__competencias INNER JOIN entrenadors 
                ON entrenador__competidor__competencias.idEntrenador = entrenadors.idEntrenador
                WHERE entrenador__competidor__competencias.numeroCompetidor = ".$data['numeroCompetidor']."   
                     AND entrenador__competidor__competencias.idCompetencia = ".$data['idCompetencia']);

            $datos['competencia'] = DB::select(" SELECT  puntaje__competidor__competencias.created_at, competencias.idCompetencia, competencias.nombreCompetencia, competencias.periodo, estatuses.estatus, puntaje__competidor__competencias.puntajeGlobal
                    FROM competidors 
                        INNER JOIN puntaje__competidor__competencias INNER JOIN competencias INNER JOIN estatuses
                    ON competidors.numeroCompetidor = puntaje__competidor__competencias.numeroCompetidor 
                        AND competencias.idCompetencia = puntaje__competidor__competencias.idCompetencia
                        AND competencias.idEstatus = estatuses.idEstatus
                        
                    WHERE 
                        puntaje__competidor__competencias.numeroCompetidor = ".$data['numeroCompetidor']."
                        AND puntaje__competidor__competencias.idCompetencia = ".$data['idCompetencia']." ");

            $datos['carreras'] = DB::select(" SELECT puntaje__competidor__carreras.idCarrera, puntaje__competidor__carreras.numeroCompetidor, competencias.idCompetencia,
                        carreras.nombreCarrera, carreras.descripcion, tipo_carreras.tipoCarrera, puntaje__competidor__carreras.puntaje, 
                        puntaje__competidor__carreras.lugarLlegada, estatuses.estatus
                    FROM puntaje__competidor__carreras 
                        INNER JOIN carreras INNER JOIN tipo_carreras INNER JOIN competencias INNER JOIN estatuses
                    ON puntaje__competidor__carreras.idCarrera = carreras.idCarrera 
                        AND carreras.idTipoCarrera = tipo_carreras.idTipoCarrera 
                        AND carreras.idCompetencia = competencias.idCompetencia
                        AND estatuses.idEstatus = puntaje__competidor__carreras.idEstatus
                    WHERE puntaje__competidor__carreras.numeroCompetidor = ".$data['numeroCompetidor']."
                        AND competencias.idCompetencia = ".$data['idCompetencia']." ");


            $datos['allEntrenadores'] = Entrenador::all();
           

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
                            
                        WHERE puntaje__competidor__competencias.numeroCompetidor = ".$data['numeroCompetidor']." ORDER BY puntaje__competidor__competencias.created_at DESC");


            $misDatos['allCompetencias'] = Competencia::all();

            $misDatos['allEntrenadores'] = Entrenador::all();


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
        $datos['competencias'] = Competencia::all();
        $datos['entrenadores'] = Entrenador::all();
        return view('competidores.front_agregar_competidor', $datos);
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
            if ($nuevoNumeroCompetidor != '') 
            {
                // Vemos si SI se va a Asignar a una Competencia junto con un Entrenador
                if($request['competencia'] != '0' && $request['entrenador'] != '0')
                {
                    //Si se valida el numero de competidor lo registramos en la base de datos
                    //Creamos el objeto del nuevo competidor 
                    $competidor = new Competidor();
                    //Evaluamos si el numero de competidor esta disponible
                    if ($competidor->where('numeroCompetidor', $nuevoNumeroCompetidor)->first() == null) 
                    {
                        //Si esta disponible aguardamos el nuevo competidor en la base de datos
                        $competidor->numeroCompetidor = $nuevoNumeroCompetidor;
                        $competidor->nombre = trim($request->nombre);
                        $competidor->apellidoPaterno = trim($request->apellidoPaterno);
                        $competidor->apellidoMaterno = trim($request->apellidoMaterno);
                        $competidor->save();

                        // Primero en la tabla entrenador_competidor_competencia
                        $nuevoEntrenamiento = new Entrenador_Competidor_Competencia();
                        $nuevoEntrenamiento->idEntrenador = $request['entrenador'];
                        $nuevoEntrenamiento->numeroCompetidor = $nuevoNumeroCompetidor;
                        $nuevoEntrenamiento->idCompetencia = $request['competencia'];

                        /// Proceso Para Calculo de Fechas
                        $fecha = date('Y-m-j');
                        $nuevafecha = strtotime ( '+'.$request['tiempoEntrenamiento'].' month' , strtotime ( $fecha ) ) ;
                        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                        
                        $nuevoEntrenamiento->fechaInicio = $fecha;
                        $nuevoEntrenamiento->fechaFin = $nuevafecha;
                        $nuevoEntrenamiento->mesesEntrenamiento = $request['tiempoEntrenamiento'];
                        $nuevoEntrenamiento->save();


                        // Asignacion en la tabla de Puntaje_Competidor_Competencia
                        $nuevaPuntajeCompetencia = new Puntaje_Competidor_Competencia();
                        $nuevaPuntajeCompetencia->numeroCompetidor = $nuevoNumeroCompetidor;
                        $nuevaPuntajeCompetencia->idCompetencia = $request['competencia'];
                        $nuevaPuntajeCompetencia->puntajeGlobal = 0;
                        $nuevaPuntajeCompetencia->save();

                        // Vamos a crear los Registros de las Carreras Correspondientes
                        $misCarreras = DB::select(" SELECT carreras.idCarrera FROM carreras INNER JOIN competencias     INNER JOIN tipo_carreras
                            ON carreras.idCompetencia = competencias.idCompetencia
                                AND carreras.idTipoCarrera = tipo_carreras.idTipoCarrera
                            WHERE competencias.idCompetencia = '".$request['competencia']."'");

                        foreach ($misCarreras as &$carrera) 
                        {
                            $nuevaPuntajeCarrera = new Puntaje_Competidor_Carrera();
                            $nuevaPuntajeCarrera->numeroCompetidor = $nuevoNumeroCompetidor;
                            $nuevaPuntajeCarrera->idCarrera = $carrera->idCarrera;
                            $nuevaPuntajeCarrera->lugarLlegada = 0;
                            $nuevaPuntajeCarrera->puntaje = 0;
                            $nuevaPuntajeCarrera->idEstatus = 5;
                            $nuevaPuntajeCarrera->save();
                        }



                        //Mansaje de confirmacion
                        return response()->json(['codigo' => 'creado', 'mensaje' => 'Competidor Creado Con Exito...']);
                    }
                    else
                    {
                        //Si el numero de competidor esta ocupado regresamos un mensaje
                        return response()->json(['codigo' => 'duplicado', 'mensaje' => 'El numero '.$nuevoNumeroCompetidor.' no esta diponible...']);
                    }
                    
                }
                else
                {
                    // Vemos si NO se va a Asignar a una Competencia junto Con un Entrenador
                    if ($request['competencia'] != '0' && $request['entrenador'] == '0') 
                    {
                        //Si se valida el numero de competidor lo registramos en la base de datos
                        //Creamos el objeto del nuevo competidor 
                        $competidor = new Competidor();
                        //Evaluamos si el numero de competidor esta disponible
                        if ($competidor->where('numeroCompetidor', $nuevoNumeroCompetidor)->first() == null) 
                        {
                            //Si esta disponible aguardamos el nuevo competidor en la base de datos
                            $competidor->numeroCompetidor = $nuevoNumeroCompetidor;
                            $competidor->nombre = trim($request->nombre);
                            $competidor->apellidoPaterno = trim($request->apellidoPaterno);
                            $competidor->apellidoMaterno = trim($request->apellidoMaterno);
                            $competidor->save();

                            // Asignacion en la tabla de Puntaje_Competidor_Competencia
                            $nuevaPuntajeCompetencia = new Puntaje_Competidor_Competencia();
                            $nuevaPuntajeCompetencia->numeroCompetidor = $nuevoNumeroCompetidor;
                            $nuevaPuntajeCompetencia->idCompetencia = $request['competencia'];
                            $nuevaPuntajeCompetencia->puntajeGlobal = 0;
                            $nuevaPuntajeCompetencia->save();

                            // Vamos a crear los Registros de las Carreras Correspondientes
                            $misCarreras = DB::select(" SELECT carreras.idCarrera FROM carreras INNER JOIN competencias     INNER JOIN tipo_carreras
                                ON carreras.idCompetencia = competencias.idCompetencia
                                    AND carreras.idTipoCarrera = tipo_carreras.idTipoCarrera
                                WHERE competencias.idCompetencia = '".$request['competencia']."'");

                            foreach ($misCarreras as &$carrera) 
                            {
                                $nuevaPuntajeCarrera = new Puntaje_Competidor_Carrera();
                                $nuevaPuntajeCarrera->numeroCompetidor = $nuevoNumeroCompetidor;
                                $nuevaPuntajeCarrera->idCarrera = $carrera->idCarrera;
                                $nuevaPuntajeCarrera->lugarLlegada = 0;
                                $nuevaPuntajeCarrera->puntaje = 0;
                                $nuevaPuntajeCarrera->idEstatus = 5;
                                $nuevaPuntajeCarrera->save();
                            }


                            //Mansaje de confirmacion
                            return response()->json(['codigo' => 'creadoSinEntrenador', 'mensaje' => 'Competidor Creado Con Exito pero no tiene un Entrenador...']);
                        }
                        else
                        {
                            //Si el numero de competidor esta ocupado regresamos un mensaje
                            return response()->json(['codigo' => 'duplicado', 'mensaje' => 'El numero '.$nuevoNumeroCompetidor.' no esta diponible...']);
                        }
                    }
                    else
                    {
                        // Vemos que solo se va a crear el competidor pero no se le va asignar ninguna Competencia.
                        if ($request['competencia'] == '0' && $request['entrenador'] == '0') 
                        {
                            //Si se valida el numero de competidor lo registramos en la base de datos
                            //Creamos el objeto del nuevo competidor 
                            $competidor = new Competidor();
                            //Evaluamos si el numero de competidor esta disponible
                            if ($competidor->where('numeroCompetidor', $nuevoNumeroCompetidor)->first() == null) 
                            {
                                //Si esta disponible aguardamos el nuevo competidor en la base de datos
                                $competidor->numeroCompetidor = $nuevoNumeroCompetidor;
                                $competidor->nombre = trim($request->nombre);
                                $competidor->apellidoPaterno = trim($request->apellidoPaterno);
                                $competidor->apellidoMaterno = trim($request->apellidoMaterno);
                                $competidor->save();

                                //Mansaje de confirmacion
                                 return response()->json(['codigo' => 'creadoSolo', 'mensaje' => 'Competidor Creado Con Exito pero aun NO esta dentro de alguna Competencia...']);
                            }
                            else
                            {
                                 //Si el numero de competidor esta ocupado regresamos un mensaje
                                return response()->json(['codigo' => 'duplicado', 'mensaje' => 'El numero '.$nuevoNumeroCompetidor.' no esta diponible...']);
                            }
                        }
                        else
                        {
                            // Quiere decir que solo tiene seleccionado un Entrenador pero no una Competencia.
                            // Regresamos un mensaje diciendo que si no puede hacer eso
                            return response()->json(['codigo' => 'soloEntrenador', 'mensaje' => 'Para asignar un entrenador, primero debe selecciona una Competencia']);
                        }
                    }
                }
               
            } 
            else
            {
                //Si el numero de competidor es 0 enviamos un mensaje
                return response()->json(['codigo' => 'numCero', 'mensaje' => 'El Numero de Competidor no puede ser Cero...']);
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
    public function update(Request $request)
    {
        if($request->ajax())
        {
            $datosCompetidor=$request->all();
            Competidor::where('numeroCompetidor','=',$request['numeroCompetidor'])->update($datosCompetidor);
              return response()->json(['codigo' => 'update', 'mensaje' => 'Actualizacion de datos con exito...']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Buscamos todos los datos del competidor en su tabla y las demas tablas de la BD
        Entrenador_Competidor_Competencia::where('numeroCompetidor', $id)->delete();
        Puntaje_Competidor_Competencia::where('numeroCompetidor', $id)->delete();
        Puntaje_Competidor_Carrera::where('numeroCompetidor', $id)->delete();
        Competidor::where('numeroCompetidor', $id)->delete();
        
        //Mensaje de Confirmacion
        return response()->json(['codigo' => 'eliminado', 'mensaje' => 'El competidor con numero '.$id.' a sido eliminado exitosamente']);
    }
}
