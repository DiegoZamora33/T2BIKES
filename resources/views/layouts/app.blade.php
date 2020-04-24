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

    <script src="{{ asset('dinamico.js') }}"></script>

  </head>
   
<body>
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
