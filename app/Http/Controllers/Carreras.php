<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrera;
use App\Competencia;
use App\TipoCarrera;

class Carreras extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $carrera['competencia'] = $datosCarrera->tipoCarrera()->first()->tipoCarrera;
            $carrera['tipo'] = $datosCarrera->competencia()->first()->nombreCompetencia;

            $carreras[] = $carrera; //Ponemos el arreglo de una carrera en el arreglo de todas las carreras
        }
        //Enviamos la informacion de las carreras a la vista
        return view('carreras.front_mostrarCarreras', compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Extraemos los datos de las competencias y tipos de carrera
        $competencias = Competencia::all('idCompetencia', 'nombreCompetencia');
        $tiposCarrera = TipoCarrera::all('idtipoCarrera', 'tipoCarrera');
       
        //Regresamos la vista para registrar una carrera
        return view('carreras.front_agregar_carrera', compact('competencias', 'tiposCarrera'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Creamos un nuevo registro en la base de datos
        Carrera::create($request->all());
        //Nos redireccionamos al index
        return redirect()->route('carreras.index');
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
        //
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
        //
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
