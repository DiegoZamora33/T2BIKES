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
                    WHERE puntaje__competidor__carreras.numeroCompetidor = '".$data['numeroCompetidor']."'
                        AND competencias.idCompetencia = '".$data['idCompetencia']."' ");

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
                    WHERE puntaje__competidor__carreras.numeroCompetidor = '".$data['numeroCompetidor']."'
                        AND competencias.idCompetencia = '".$data['idCompetencia']."' ");

        return view('graficas.competidor_competencia_bar', $datos);
    }
}