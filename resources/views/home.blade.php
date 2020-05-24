@extends('layouts.app')

@section('content')
<input type="hidden" name="_tokenG" value="{{ csrf_token() }}" id="tokenG">
<div class="wrapper">
        <!-- Sidebar  -->
        <div id="lateral">
            <nav id="sidebar">
                <div class="sidebar-header text-center">
                <img src="{{ asset('t2bikes/img/logo.png') }}" width="100" alt="logo_principal">
                </div>

                <ul class="list-unstyled components">
                    <li class="active mt-2" id="home">
                        <a href="home">
                            <i class="fas fa-home"></i>
                            <span class="CTAs">Inicio</span>
                        </a>
                    </li>

                    <li class="mt-1 text-center" id="competidores">
                        <a href="#">
                            <i class="demo-icon icon-bicycle"></i>
                            <span class="CTAs">Competidores</span>
                        </a>
                    </li>

                    <li class="mt-1" id="entrenadores">
                        <a href="#">
                            <i class="fas fa-stopwatch"></i>
                            <span class="CTAs">Entrenadores</span>
                        </a>

                    </li>

                    <li class="mt-1" id="portaCompetencias">
                        <a id="competencias" href="#pageCompetencias" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="demo-icon icon-calendar-check-o"></i>
                            <span class="CTAs">Competencias</span>
                        </a>
                        <ul class="collapse list-unstyled" id="pageCompetencias">

                        @foreach($competencias as $miCompetList)
                            <li style="cursor: pointer;" id="{{ $miCompetList->idCompetencia }}" onclick="getTour(this);" >
                                <a>{{ $miCompetList->nombreCompetencia }}</a>
                            </li>
                        @endforeach

                        </ul>
                    </li>



                    @if(Auth::user()->idtipoUsuario == 1)
                        <li class="mt-1" id="sistema">
                            <a href="#">
                                <i class="fas fa-users"></i>
                                <span class="CTAs">Control de Usuarios</span>
                            </a>
                        </li>
                    @endif


                </ul>

                <div class="d-lg-block d-md-block d-sm-none">
                <ul class="list-unstyled CTAs ">
                    <li>
                        <a class="btn btn-danger pl-5" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form-1').submit();">
                            <i class="fas fa-sign-out-alt iconoSalir"></i>
                            Cerrar sesión
                        </a>

                        <form id="logout-form-1" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
                </div>


                <ul class="closeSesion">
                    <li>
                        <a class="btn-sm btn-danger pl-1" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt iconoSalir"></i>
                            <label class="cerrarSesionR">Cerrar sesión</label>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                              <form>
                                <div class="form-group mt-lg-auto mt-md-3 mt-sm-4 mt-4">
                                  <input type="text" class="form-control" onkeyup="buscar()" id="busqueda" aria-describedby="Buscar" placeholder="Buscar">
                                </div>
                              </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container text-center" id="mostrador">

                <h2>Bienvenido {{ Auth::user()->name }}</h2>

                @if(Auth::user()->idtipoUsuario == 1)
                     <h4>Estas Registrado como: Administrador</h4>
                @elseif (Auth::user()->idtipoUsuario == 2)
                     <h4>Estas Registrado como: Registro</h4>
                 @elseif (Auth::user()->idtipoUsuario == 3)
                     <h4>Estas Registrado como: Consulta</h4>
                @endif


                <p>Recuerda siempre cerrar tu sesión</p>
                <p> {{ session('status') }}</p>

            </div>
        </div>
    </div>
@endsection
