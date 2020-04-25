<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoCarrera;

class TiposCarreras extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Extraemos todos los tipos de carrera
        $tiposCarrera = TipoCarrera::all();
        //Enviamos la informacion de los entrenadores y llamamos a la vista
        return view('tiposCarrera.front_mostrarTiposCarreras', compact('tiposCarrera'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Regresamos la vista para registrar un nuevo tipo de carrera
        return view('tiposCarrera.front_agregar_tipo_carrera');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Creamos un nuvo registro en la base de datos
        TipoCarrera::create($request->all());
        //Nos redireccionamos al index
        return redirect()->route('tiposcarrera.index');
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
        //Extraemos la informacion del tipo de carrera deseado
        $tipoCarrera = TipoCarrera::where('idTipoCarrera', $id)->first();
        //Enviamos la informacion del tipo de carrera y mostramos la vista
        return view('tiposCarrera.front_editar_tipo_carrera', compact('tipoCarrera'));
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
        //Extraemos los datos no necesarios del request
        $datosNuevos=request()->except(['_token','_method']);
        //Actualizamos los datos en la BD
        TipoCarrera::where('idTipoCarrera', $id)->update($datosNuevos);
        //Regresamos al index
        return redirect()->route('tiposcarrera.index');
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
