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
            $carrera['tipo'] = $datosCarrera->tipoCarrera()->first()->tipoCarrera;
            $carrera['competencia'] = $datosCarrera->competencia()->first()->nombreCompetencia;

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
        //Extraemos la informacion de la base de datos de la carrera deseada
        $carrera = Carrera::where('idCarrera', $id)->first();
        
        //Creamos un arreglo para los datos a mostrar y agregamos los datos
        $datos = array();
        $datos['nombre'] = $carrera->nombreCarrera;
        $datos['descripcion'] = $carrera->descripcion;
        $datos['tipo'] = $carrera->tipoCarrera()->first()->tipoCarrera;
        $datos['competencia'] = $carrera->competencia()->first()->nombreCompetencia;
        
        //Mostramos la vista y mandamos la informacion
        return view('carreras.front_mostrar_Carrera', compact('datos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Extraemos los datos de las competencias y tipos de carrera
        $competencias = Competencia::all('idCompetencia', 'nombreCompetencia');
        $tiposCarrera = TipoCarrera::all('idtipoCarrera', 'tipoCarrera');
        
        //Extraemos la informacion de la base de datos de la carrera deseada
        $carrera = Carrera::where('idCarrera', $id)->first();

        //Mostramos la vista y mandamos la informacion
        return view('carreras.front_editar_carrera', compact('competencias', 'tiposCarrera', 'carrera'));
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
        Carrera::where('idCarrera', $id)->update($nuevosDatos);

        //Nos redireccionamos al index
        return redirect()->route('carreras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Buscamos y eliminamos el registro de la bd con el id
        Carrera::where('idCarrera', $id)->delete();
        //Regresamos al indice
        return redirect()->route('carreras.index');
    }
}
