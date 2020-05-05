<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>

    <title>T2Bikes</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('t2bikes/img/favicon.ico') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!--Palabras clave-->
    <meta name="keywords" content="Web, Login, T2Bikes, Morelia, Bicicleta">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="{{ asset('t2bikes/css/bootstrap.css') }}">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('t2bikes/css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('t2bikes/css/fontello.css') }}">
    <link rel="stylesheet" href="{{ asset('t2bikes/css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('t2bikes/css/table.css') }}">

    <!-- Font Awesome JS -->
    <script src="{{ asset('t2bikes/js/fontawesome-solid.js') }}"></script>
    <script src="{{ asset('t2bikes/js/fontawesome-5.js') }}"></script>

    <script src="{{ asset('t2bikes/js/poper.js') }}"></script>

    <script type="text/javascript" src="{{ asset('t2bikes/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('t2bikes/js/bootstrap.js') }}" charset="utf-8"></script>

    <script src="{{ asset('t2bikes/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('t2bikes/js/chart.js') }}"></script>
    <script src="{{ asset('t2bikes/js/jspdf.min.js') }}"></script>

    <script src="{{ asset('t2bikes/js/jspdf.plugin.autotable.min.js') }}"></script>

    <script src="{{ asset('dinamico.js') }}"></script>
    <script src="{{ asset('inserts.js') }}"></script>
    <script src="{{ asset('updates.js') }}"></script>
    <script src="{{ asset('deletes.js') }}"></script>

    <script src="{{ asset('t2bikes/js/alert.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('t2bikes/css/animate.css') }}">

  </head>

<body>
    <div id="app">

        <!-- Para poder Registrar un nuevo Usuario usando el NAV de LARAVEL Descometar el nav siguiente -->

        <!--nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav-->


        @yield('content')
    </div>
</body>
</html>
