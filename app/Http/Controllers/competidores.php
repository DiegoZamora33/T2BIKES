<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class competidores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['competidores']=Competidores::paginate(5);
        return view('competidores.front_mostrar_competidor',$datos);
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
        //
        $competidor = Competidores::findOrFail($id);
        return view('competidores.front_editar_competidor',compact('competidor'));
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
        $datosCompetidor=request()->except(['_token','_method']);
        Competidores::where('numeroCompetidor','=',$numeroCompetidor)->update($datosCompetidor);
        
        $competidor = Competidores::findOrFail($id);
        return view('competidores.front_editar_competidor',compact('competidor'));
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
        Competidores::destroy($id);
        return redirect('competidores');
    }
}
