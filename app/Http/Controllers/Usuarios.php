<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

}