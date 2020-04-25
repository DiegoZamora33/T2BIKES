<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competidor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['competidores']=Competidor::paginate(5);
        return view('home',$datos);
        //return view('home');
    }



    public function expe()
    {
        return view('experimento');
    }
}
