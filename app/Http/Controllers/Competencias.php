<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competencia;
use App\Estatus;
class Competencias extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       //inner join 

        $competencias = Competencia::join("estatuses","estatuses.idEstatus","=","competencias.idEstatus")
        -> select("idCompetencia","nombreCompetencia","periodo","estatus")
        ->get();
        return view('competencia.front_mostrar_competencias', compact('competencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('competencia.front_agregar_competencia');
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
        //Creamos un nuevo registro en la base de datos
        Competencia::create($request->all());
        //Nos redireccionamos al index
        return redirect()->route('competencias.index');
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
       
        //Extraemos la informacion de la competencia deseada
        $competencia= Competencia::where('idCompetencia', $id)->first();

        $estatus = Estatus::where('idEstatus',$competencia->idEstatus)->first();
        //Enviamos la informacion 
        return view('competencia.front_editar_competencia', compact('competencia','estatus'));
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
          $nuevosDatos=request()->except(['_token','_method','estado']);
        //Actualizamos los campos de la bd con los nuevos datos
        Competencia::where('idCompetencia', $id)->update($nuevosDatos);
        //Nos redireccionamos al index
        return redirect()->route('competencias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //buscammos coincidencia de una competencia con el id y se elimina
        Competencia::where('idCompetencia', $id)->delete();
        return redirect()->route('competencias.index');
    }
}
