<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competencia;
use App\Estatus;
use App\TipoCarrera;
use App\Entrenador_Competidor_Competencia;
use App\Puntaje_Competidor_Competencia;
use App\Puntaje_Competidor_Carrera;
use App\Carrera;
use App\Entrenador;
use Illuminate\Support\Facades\DB;
include('miDB.php');



class Competencias extends Controller
{

    public function index()
    {
        
       //Buscamos datos de las competencias

       $query = " SELECT competencias.idCompetencia, competencias.nombreCompetencia, competencias.periodo, estatuses.estatus
       FROM competencias 
        INNER JOIN estatuses
        ON  competencias.idEstatus = estatuses.idEstatus
        ORDER BY competencias.created_at DESC";

        $datos['competencias'] = bd_consulta($query);

        return view('competencia.front_mostrar_competencias', $datos);
    }

    public function quitarCompetidor(Request $data)
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
                    $competidor = DB::select(" SELECT * FROM competidors WHERE numeroCompetidor = ".$data['numeroCompetidor']." ");
                    $competencia = DB::select(" SELECT * FROM competencias WHERE idCompetencia = ".$data['idCompetencia']." ");
                    $out = "Estas apunto de quitar a ";
                     foreach ($competidor as &$miCompetidor) 
                     {
                        $out = $out."'".$miCompetidor->nombre." ".$miCompetidor->apellidoPaterno." ".$miCompetidor->apellidoMaterno."' (".$data['numeroCompetidor'].") de la competencia ";
                     }

                     foreach ($competencia as &$miCompetencia) 
                     {
                        $out = $out.$miCompetencia->nombreCompetencia;
                     }

                    // Esto vas a quitar
                     return response()->json(['codigo' => 'confirm', 'mensaje' => $out]);
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

    public function agregarQuitar(Request $data)
    {
        if ($data->ajax()) 
        {
            // Buscamos mi Competencia
            $datos['competencia'] = Competencia::where('idCompetencia', '=', $data['idCompetencia'])->first();
            $datos['entrenadores'] = Entrenador::all();


            return view('competencia.front_agregar_quitar_competidores', $datos);
        }
    }


    public function statDinamic(Request $data)
    {
        if($data->ajax())
        {
            $datos['puntajesGlobales'] = DB::select(" SELECT competidors.numeroCompetidor, competidors.nombre, competidors.apellidoPaterno, competidors.apellidoMaterno, puntaje__competidor__competencias.puntajeGlobal
                    FROM competencias INNER JOIN puntaje__competidor__competencias INNER JOIN competidors
                    ON puntaje__competidor__competencias.idCompetencia = competencias.idCompetencia
                        AND competidors.numeroCompetidor = puntaje__competidor__competencias.numeroCompetidor
                    WHERE competencias.idCompetencia = ".$data['idCompetencia']." ORDER BY puntaje__competidor__competencias.puntajeGlobal DESC LIMIT ".$data['numero']." ");

            return view('competencia.front_estadistica_competencia', $datos);
        }
    }


    public function perfilCompetencia(Request $data)
    {
        if($data->ajax())
        {
            // Buscamos los datos de mi Competencia
            $datos['competencia'] = DB::select(" SELECT competencias.idCompetencia, competencias.nombreCompetencia, competencias.periodo, competencias.created_at, competencias.idEstatus ,estatuses.estatus 
                    FROM competencias INNER JOIN estatuses ON competencias.idEstatus = estatuses.idEstatus
                    WHERE competencias.idCompetencia = ".$data['idCompetencia']." ");


            $datos['puntajesGlobales'] = DB::select(" SELECT competidors.numeroCompetidor, competidors.nombre, competidors.apellidoPaterno, competidors.apellidoMaterno, puntaje__competidor__competencias.puntajeGlobal
                    FROM competencias INNER JOIN puntaje__competidor__competencias INNER JOIN competidors
                    ON puntaje__competidor__competencias.idCompetencia = competencias.idCompetencia
                        AND competidors.numeroCompetidor = puntaje__competidor__competencias.numeroCompetidor
                    WHERE competencias.idCompetencia = ".$data['idCompetencia']." ORDER BY puntaje__competidor__competencias.puntajeGlobal DESC LIMIT 4");

            $datos['numParticipantes'] = DB::select("SELECT COUNT(*) inscritos FROM competencias
                   INNER JOIN puntaje__competidor__competencias
                    ON competencias.idCompetencia = puntaje__competidor__competencias.idCompetencia
                    WHERE puntaje__competidor__competencias.idCompetencia = ".$data['idCompetencia']."");

            $datos['numCarreras'] = DB::select(" SELECT COUNT(*) AS carreras FROM competencias 
                    INNER JOIN carreras INNER JOIN estatuses
                    ON competencias.idCompetencia = carreras.idCompetencia 
                        AND competencias.idEstatus = estatuses.idEstatus
                    WHERE carreras.idCompetencia = ".$data['idCompetencia']."");

            $datos['carreras'] = DB::select(" SELECT carreras.idCarrera, carreras.nombreCarrera, carreras.descripcion, tipo_carreras.tipoCarrera
                    FROM competencias INNER JOIN carreras INNER JOIN estatuses INNER JOIN tipo_carreras
                    ON competencias.idCompetencia = carreras.idCompetencia 
                        AND tipo_carreras.idTipoCarrera = carreras.idTipoCarrera
                        AND competencias.idEstatus = estatuses.idEstatus
                    WHERE carreras.idCompetencia = ".$data['idCompetencia']." ORDER BY carreras.created_at ASC");

            $datos['tiposCarreras'] = DB::select("SELECT * FROM tipo_carreras ORDER BY created_at DESC");

            return view('competencia.front_perfil_competencia', $datos);
        }
    }


    public function create()
    {
        //
        return view('competencia.front_agregar_competencia');
    }


    public function store(Request $request)
    {
        //Verificamos que no se repita el nombre de la competencia
        if (Competencia::where('nombreCompetencia',$request->nombreCompetencia)->first() == null) {
            //Creamos un nuevo registro en la base de datos
            $nuevaCompetencia = new Competencia();
            $nuevaCompetencia->nombreCompetencia = $request->nombreCompetencia;
            $nuevaCompetencia->periodo = $request->periodo;
            $nuevaCompetencia->idEstatus = 2;
            $nuevaCompetencia->save();
            //Mensaje de confirmacion
            return response()->json(['codigo' => 'registrado', 'mensaje' => 'La competencia '.$request->nombreCompetencia.' a sido registrada satisfactoriamente']);
        }
        //Mensaje de advertencia
        return response()->json(['codigo' => 'repetido', 'mensaje' => 'La competencia '.$request->nombreCompetencia.' ya se registro anteriormente']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
       
        //Extraemos la informacion de la competencia deseada
        $competencia= Competencia::where('idCompetencia', $id)->first();

        $estatus = Estatus::where('idEstatus',$competencia->idEstatus)->first();
        //Enviamos la informacion 
        return view('competencia.front_editar_competencia', compact('competencia','estatus'));
    }


    public function update(Request $request, $id)
    {
        //Verificamos que no se repita el nombre de la competencia o si se dejo el mismo
        if (Competencia::where('nombreCompetencia',$request->nombreCompetencia)->first() == null || Competencia::where('idCompetencia', $id)->first()->nombreCompetencia == $request->nombreCompetencia) {
            //Actualizamos los campos de la bd con los nuevos datos
            Competencia::where('idCompetencia', $id)->update(['nombreCompetencia'=>$request->nombreCompetencia, 'periodo'=>$request->periodo]);
            //Mensaje de Confirmacion
            return response()->json(['codigo' => 'actualizado', 'mensaje' => 'La competencia '.$request->nombreCompetencia.' a sido editada satisfactoriamente']);
        }
        //Mensaje de advertencia
        return response()->json(['codigo' => 'repetido', 'mensaje' => 'El nombre '.$request->nombreCompetencia.' ya esta ocupado por otra competencia']);
    }


    public function destroy($id)
    {
        //Buscamos el nombre de la competencia
        $nombreCompetencia = Competencia::where('idCompetencia', $id)->first()->nombreCompetencia;
        
        //Eliminamos las carreras relacionadas con la competencia
        $carreras = DB::select("SELECT idCarrera FROM carreras WHERE idCompetencia = '".$id."'");
        foreach ($carreras as $carrera) {
            Puntaje_Competidor_Carrera::where('idCarrera', $carrera->idCarrera)->delete();
            Carrera::where('idCarrera', $carrera->idCarrera)->delete();
        }

        //Eliminamos la competencia de la base de datos
        Entrenador_Competidor_Competencia::where('idCompetencia', $id)->delete();
        Puntaje_Competidor_Competencia::where('idCompetencia', $id)->delete();
        Competencia::where('idCompetencia', $id)->delete();

        //Mensaje de confirmacion
        return response()->json(['codigo' => 'eliminada', 'mensaje' => 'La competencia '.$nombreCompetencia.' a sido eliminada exitosamente']);
    }

    //Funcion para finalzar una competencia
    public function finalizarCompetencia(Request $request)
    {
        $competencia = Competencia::where('idCompetencia',$request->idCompetencia)->first();
        Competencia::where('idCompetencia', $request->idCompetencia)->update(['idEstatus'=>'1']);
        return response()->json(['codigo' => 'finalizada', 'mensaje' => 'La competencia '.$competencia->nombreCompetencia.' a sido finalizada exitosamente']);
    }
}
