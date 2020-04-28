<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class Usuarios extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['usuarios'] = DB::select('SELECT name, email, idtipoUsuario, created_at FROM users');
        return view('usuarios.front_mostrar_usuarios', $datos);
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
                    User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => bcrypt($data['password']),
                        'idtipoUsuario' => $data['idtipoUsuario'],
                    ]);

                    return response()->json(["mensaje" => "creado", "name" => $data['name'], "email" => $data['email']]);
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

        //return view('home');
    }
}