<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
