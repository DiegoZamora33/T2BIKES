<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entrenador;
use App\Entrenador_Competidor_Competencia;

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
        $entrenadores = Entrenador::orderBy('created_at', 'DESC')->get();
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
        if($request->ajax())
        {
            Entrenador::create($request->all());
            return response()->json(['codigo' => 'registrado', 'mensaje' => 'El entrenador '.$request->nombre.' '.$request->apellidoPaterno.' '.$request->apellidoMaterno.' a sido registrado correctamente']);
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
        //Regresamos mensaje de confirmacion
        return response()->json(['codigo' => 'actualizado', 'mensaje' => 'El entrenador '.$request->nombre.' '.$request->apellidoPaterno.' '.$request->apellidoMaterno.' a sido actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Buscamos el nombre de entrenador
        $entrenador = Entrenador::where('idEntrenador', $id)->first();
        $nombreEntrenador = $entrenador->nombre.' '.$entrenador->apellidoPaterno.' '.$entrenador->apellidoMaterno;
        
        //Eliminamos al entrenador de la base de datos
        Entrenador_Competidor_Competencia::where('idEntrenador', $id)->delete();
        Entrenador::where('idEntrenador', $id)->delete();

        //Mensaje de confirmacion
        return response()->json(['codigo' => 'Eliminado', 'mensaje' => 'El entrenador '.$nombreEntrenador.' a sido eliminado correctamente']);
    }
}
