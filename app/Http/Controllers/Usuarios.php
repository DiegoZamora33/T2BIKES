<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\TipoUsuario;

class Usuarios extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['usuarios'] = DB::select('SELECT name, email, tipo_usuarios.tipo AS idtipoUsuario, users.created_at FROM users INNER JOIN tipo_usuarios WHERE users.idtipoUsuario = tipo_usuarios.idTipoUsuario');
        
        return view('usuarios.front_mostrar_usuarios', $datos);
    }

    public function perfilUsuario(Request $data)
    {
        if($data->ajax())
        {   
            //Extraemos la informacion de la Base de Datos
            $usuario = User::where('email', $data['user'])->first();
            $tipoUsuario = $usuario->tipoUsuario()->first();

            //Tipos de Usuario
            $tiposUsuario = TipoUsuario::all();

            //Mostramos la Vista
            return view('usuarios.front_perfil_usuario', compact('usuario', 'tiposUsuario'));
        }

    }

    public function show($id)
    {
        //
    }

    public function create()
    {
        return view('usuarios.front_agregar_usuario');
    }


    public function store(Request $data)
    {
        if($data->ajax())
        {
            if($data['idtipoUsuario'] != "0")
            {
                if(User::where('email','=',$data['email'])->first() == null)
                {
                    //Verificacion de la confirmacion de la contraseña
                    if ($data['password'] == $data['passwordConfirm']) {
                        User::create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'password' => bcrypt($data['password']),
                            'idtipoUsuario' => $data['idtipoUsuario'],
                        ]);
                        return response()->json(["mensaje" => "creado", "name" => $data['name'], "email" => $data['email']]);

                    } else {
                        return response()->json(["mensaje" => "passwordNoCoincide"]);
                    }
                }
                else
                {
                    return response()->json(["mensaje" => "duplicado", "name" => $data['name'], "email" => $data['email']]);
                }
            }
            else
            {
                return response()->json(["mensaje" => "noUsuario", "name" => $data['name'], "email" => $data['email']]);
            }
        }
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
        //Buscamos al usuario en la BD
        $usuario = User::find($id);

        $usuario->name = $request->name;
        $usuario->idtipoUsuario = $request->idtipoUsuario;

        //Verificamos si es su mismo correro o si el nuevo correo esta disponible
        if ($usuario->email == $request->email || User::where('email', $request->email)->first() == null) {
            $usuario->email = $request->email;            
        } else {
            return response()->json(["codigo" => "correoOcupado", "mensaje" => 'El email '.$request->email.' ya esta ocupado por otro usuario, escriba otro']);
        }

        //Verificamos si actualizo la contraseña
        if ($request->password != '') {
            //Verificamos si las nuevas contraseñas coinciden
            if ($request->password == $request->passwordConfirm) {
                $usuario->password =  bcrypt($request->password);
            }else {
                return response()->json(["codigo" => "noCoincidePassword", "mensaje" => 'Las nuevas contraseñas no coinciden, por favor vuelva a confirmar la nueva contraseña']);
            }
        }

        $usuario->save();
        return response()->json(["codigo" => "updated", "mensaje" => 'El usuario '.$usuario->name.' a sido actualizado satisfactoriamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Buscamos el nombre del usuario en la base de datos
        $nombreUsuario = User::find($id)->name;

        //Verificamos que el usuario principal no pueda ser elimando
        if ($id == '1') {
            return response()->json(['codigo' => 'root', 'mensaje' => 'El Usuario '.$nombreUsuario.' no puede ser eliminado']);
        }

        //Verificamos que no se pueda eliminar a si mismo
        if ($id == auth()->user()->id) {
            return response()->json(['codigo' => 'autoEliminacion', 'mensaje' => 'No puedes Eliminar tu propio Usuario']);
        }

        //Si no es el usuario principal y no es el mismo lo eliminamos
        User::destroy($id);
        return response()->json(['codigo' => 'eliminado', 'mensaje' => 'El Usuario '.$nombreUsuario.' a sido eliminado exitosamente']);
    }
}