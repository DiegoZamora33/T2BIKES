<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entrenador;

class Entrenadores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Extraemos todos los datos de los entrenadores
        $entrenadores = Entrenador::all();
        //Enviamos la informacion de los entrenadores y llamamos a la vista
        return view('entrenadores.front_mostrar_entrenadores', compact('entrenadores'));
    }

    public function perfilEntrenador(Request $data)
    {
        if($data->ajax())
        {
            // Buscamos la informacion de mi Entrenador
            $datos['entrenador'] = Entrenador::where('idEntrenador','=', $data['idEntrenador'])->first();
            
            // Buscamos a sus Entrenamientos...
            $datos['entrenamientos'] =  DB::select(" SELECT competidors.nombre, competidors.apellidoPaterno, competidors.apellidoMaterno, competidors.numeroCompetidor,
                competencias.nombreCompetencia, entrenador__competidor__competencias.mesesEntrenamiento, 
                entrenador__competidor__competencias.fechaInicio, entrenador__competidor__competencias.fechaFin
            FROM entrenadors INNER JOIN entrenador__competidor__competencias INNER JOIN competidors INNER JOIN competencias
            ON entrenadors.idEntrenador = entrenador__competidor__competencias.idEntrenador 
                AND entrenador__competidor__competencias.numeroCompetidor = competidors.numeroCompetidor
                AND entrenador__competidor__competencias.idCompetencia = competencias.idCompetencia
            WHERE entrenadors.idEntrenador = ".$data['idEntrenador']." ");

            $datos['total'] = DB::select(" SELECT COUNT(*) AS total FROM entrenadors INNER JOIN entrenador__competidor__competencias INNER JOIN competidors INNER JOIN competencias
                ON entrenadors.idEntrenador = entrenador__competidor__competencias.idEntrenador 
                    AND entrenador__competidor__competencias.numeroCompetidor = competidors.numeroCompetidor
                    AND entrenador__competidor__competencias.idCompetencia = competencias.idCompetencia
                WHERE entrenadors.idEntrenador = ".$data['idEntrenador']." ");

            return view('entrenadores.front_perfil_entrenador',$datos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entrenadores.front_agregar_entrenador');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Entrenador::create($request->all());
        return redirect()->route('entrenadores.index');
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
        //Extraemos la informacion del entrenador deseado
        $entrenador = Entrenador::where('idEntrenador', $id)->first();
        
        //Enviamos la informacion del entrenador y mostramos la vista
        return view('entrenadores.front_editar_entrenador', compact('entrenador'));
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
        //Quitamos los datos no deseados del request
        $nuevosDatos=request()->except(['_token','_method']);
        //Actualizamos los campos de la bd con los nuevos datos
        Entrenador::where('idEntrenador', $id)->update($nuevosDatos);
        //Nos redireccionamos al index
        return redirect()->route('entrenadores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Entrenador::where('idEntrenador', $id)->delete();
        return redirect()->route('entrenadores.index');
    }
}
