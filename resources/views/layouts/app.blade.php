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
    <link rel="stylesheet" href="{{ asset('t2bikes/css/fontello2.css') }}">
    <link rel="stylesheet" href="{{ asset('t2bikes/css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('t2bikes/css/table.css') }}">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="{{ asset('t2bikes/js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="{{ asset('t2bikes/js/fontawesome-solid.js') }}"></script>
    <script src="{{ asset('t2bikes/js/fontawesome-5.js') }}"></script>

    <script src="{{ asset('t2bikes/js/poper.js') }}"></script>


    <script src="{{ asset('t2bikes/js/bootstrap.js') }}" charset="utf-8"></script>

    <script src="{{ asset('t2bikes/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('t2bikes/js/chart.js') }}"></script>
    <script src="{{ asset('t2bikes/js/jspdf.min.js') }}"></script>

    <script src="{{ asset('t2bikes/js/jspdf.plugin.autotable.min.js') }}"></script>
    <script src="{{ asset('t2bikes/js/html2canvas.js') }}"></script>
    <script src="{{ asset('t2bikes/js/jspdf.plugin.html.min.js') }}"></script>
    <script src="{{ asset('t2bikes/js/jspdf.plugin.addHTML.min.js') }}"></script>

    <script src="{{ asset('dinamico.js') }}"></script>
    <script src="{{ asset('inserts.js') }}"></script>
    <script src="{{ asset('updates.js') }}"></script>
    <script src="{{ asset('deletes.js') }}"></script>
    <script src="{{ asset('generatePDF.js') }}"></script>

    <script src="{{ asset('t2bikes/js/alert.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('t2bikes/css/animate.css') }}">

  </head>

<body>
    <div id="app">

        <input type="hidden" value="<?php echo $_SERVER['SERVER_ADDR']; ?>" id="miIP">
        
        @yield('content')
    </div>
</body>
</html>
