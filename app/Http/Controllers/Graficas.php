<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Graficas extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function competidor_competencia_pai(Request $data)
    {
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

        return view('graficas.competidor_competencia_pai', $datos);
    }

    public function competidor_competencia_bar(Request $data)
    {
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

        return view('graficas.competidor_competencia_bar', $datos);
    }

    public function competencia_bar(Request $data)
    {
        if($data->ajax())
        {
            // Buscamos los datos de puntajes y demas
            $datos['puntajesGlobales'] = DB::select(" SELECT competidors.numeroCompetidor, competidors.nombre, competidors.apellidoPaterno, competidors.apellidoMaterno, puntaje__competidor__competencias.puntajeGlobal
                    FROM competencias INNER JOIN puntaje__competidor__competencias INNER JOIN competidors
                    ON puntaje__competidor__competencias.idCompetencia = competencias.idCompetencia
                        AND competidors.numeroCompetidor = puntaje__competidor__competencias.numeroCompetidor
                    WHERE competencias.idCompetencia = ".$data['idCompetencia']." ORDER BY puntaje__competidor__competencias.puntajeGlobal DESC LIMIT ".$data['totalMostrar']." ");

            return view('graficas.competencia_bar', $datos);
        }
    }

    public function competencia_pai(Request $data)
    {
        if($data->ajax())
        {
            // Buscamos los datos de puntajes y demas
            $datos['puntajesGlobales'] = DB::select(" SELECT competidors.numeroCompetidor, competidors.nombre, competidors.apellidoPaterno, competidors.apellidoMaterno, puntaje__competidor__competencias.puntajeGlobal
                    FROM competencias INNER JOIN puntaje__competidor__competencias INNER JOIN competidors
                    ON puntaje__competidor__competencias.idCompetencia = competencias.idCompetencia
                        AND competidors.numeroCompetidor = puntaje__competidor__competencias.numeroCompetidor
                    WHERE competencias.idCompetencia = ".$data['idCompetencia']." ORDER BY puntaje__competidor__competencias.puntajeGlobal DESC LIMIT ".$data['totalMostrar']." ");

            return view('graficas.competencia_pai', $datos);
        }
    }

    public function carrera_bar(Request $data)
    {
        if($data->ajax())
        {
            // Buscamos a mis participantes de esta carrera
            $datos['participantes'] = DB::select(" SELECT competidors.numeroCompetidor, competidors.nombre, competidors.apellidoPaterno, competidors.apellidoMaterno,
                    puntaje__competidor__carreras.lugarLlegada, puntaje__competidor__carreras.puntaje, estatuses.estatus
                FROM carreras INNER JOIN puntaje__competidor__carreras INNER JOIN competencias INNER JOIN competidors INNER JOIN estatuses
                ON carreras.idCarrera = puntaje__competidor__carreras.idCarrera 
                    AND carreras.idCompetencia = competencias.idCompetencia
                    AND competidors.numeroCompetidor = puntaje__competidor__carreras.numeroCompetidor
                    AND estatuses.idEstatus = puntaje__competidor__carreras.idEstatus
                WHERE carreras.idCarrera = ".$data['idCarrera']."
                    AND competencias.idCompetencia = ".$data['idCompetencia']." ORDER BY puntaje__competidor__carreras.lugarLlegada ASC LIMIT ".$data['totalMostrar']." ");

            return view('graficas.carrera_bar', $datos);
        }
    }

    public function carrera_pai(Request $data)
    {
        if($data->ajax())
        {
            // Buscamos a mis participantes de esta carrera
            $datos['participantes'] = DB::select(" SELECT competidors.numeroCompetidor, competidors.nombre, competidors.apellidoPaterno, competidors.apellidoMaterno,
                    puntaje__competidor__carreras.lugarLlegada, puntaje__competidor__carreras.puntaje, estatuses.estatus
                FROM carreras INNER JOIN puntaje__competidor__carreras INNER JOIN competencias INNER JOIN competidors INNER JOIN estatuses
                ON carreras.idCarrera = puntaje__competidor__carreras.idCarrera 
                    AND carreras.idCompetencia = competencias.idCompetencia
                    AND competidors.numeroCompetidor = puntaje__competidor__carreras.numeroCompetidor
                    AND estatuses.idEstatus = puntaje__competidor__carreras.idEstatus
                WHERE carreras.idCarrera = ".$data['idCarrera']."
                    AND competencias.idCompetencia = ".$data['idCompetencia']." ORDER BY puntaje__competidor__carreras.lugarLlegada ASC LIMIT ".$data['totalMostrar']." ");

            return view('graficas.carrera_pai', $datos);
        }
    }
}