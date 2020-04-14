<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competidor;

class competidores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['competidores']=Competidor::paginate(5);
        return view('competidores.front_mostrar_competidor',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('competidores.front_agregar_competidor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Quitamos los 0 a la izquierda del numero de competidor para aguardarlo en la base de datos
        $nuevoNumeroCompetidor = '';
        for ($i=0; $i < strlen($request->numeroCompetidor); $i++) { 
            if ($request->numeroCompetidor[$i] != '0') {
                $nuevoNumeroCompetidor = substr($request->numeroCompetidor , $i, strlen($request->numeroCompetidor)-$i);
                break;
            }
        }

        //Verificamos si el numero no es 0 si es asi lanzamos el mensaje
        if ($nuevoNumeroCompetidor != '') {
            //Si se valida el numero de competidor lo registramos en la base de datos
            //Creamos el objeto del nuevo competidor 
            $competidor = new Competidor();
            //Evaluamos si el numero de competidor esta disponible
            if ($competidor->where('numeroCompetidor', $nuevoNumeroCompetidor)->first() == null) {
                //Si esta disponible aguardamos el nuevo competidor en la base de datos
                $competidor->numeroCompetidor = $nuevoNumeroCompetidor;
                $competidor->nombre = trim($request->nombre);
                $competidor->apellidoPaterno = trim($request->apellidoPaterno);
                $competidor->apellidoMaterno = trim($request->apellidoMaterno);
                $competidor->fechaRegistro = $request->fechaRegistro;
                $competidor->save();
                //Mansaje de confirmacion
                return 'Registrado';
            }else{
                //Si el numero de competidor esta ocupado regresamos un mensaje
                return 'Numero de Competidor ya ocupado por otro competidor';
            }
            echo $nuevoNumeroCompetidor;
        } else{
            //Si el numero de competidor es 0 enviamos un mensaje
            return 'El numero de competidor no puede ser cero';
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
        $competidor = Competidor::where('numeroCompetidor', $id)->first();

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
        $datosCompetidor=request()->except(['_token','_method']);
        Competidor::where('numeroCompetidor','=',$id)->update($datosCompetidor);
        
        $competidor = Competidor::where('numeroCompetidor', $id)->first();
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
        //Buscamos al competidor con el id dado y lo eliminamos
        Competidor::where('numeroCompetidor', $id)->delete();
        //Mensaje de confirmacion
        return 'Eliminado';
    }
}
