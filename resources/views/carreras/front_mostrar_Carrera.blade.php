<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrera</title>
</head>
<style>
    *{
        font-size: 1.3em;
        font-weight: bold;
    }
    label{
        font-weight: 100;
    }
</style>
<body>
    <p>Nombre  :<label>{{$datos['nombre']}}</label></p>
    <p>Descripcion  :<label>{{$datos['descripcion']}}</label></p>
    <p>Competencia  :<label>{{$datos['competencia']}}</label></p>
    <p>Tipo de Carrera  :<label>{{$datos['tipo']}}</label></p>
</body>
</html>