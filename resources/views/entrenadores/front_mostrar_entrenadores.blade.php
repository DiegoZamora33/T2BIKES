<!--DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Entrenador</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        text-align: center;
    }
    h1{
        padding: 1rem;
    }
    table{
        width: 100%;
    }
    tr > *{
        padding: 1rem;
        text-align: left;
        border: 1px black solid;
    }
    .btnCrearEntrenador{
        margin: 1em;
    }
</style>
<body>
    <h1>Listado de Entrenadores</h1>
    <table>
        <thead>
            <th></th>
            <th>Nombre</th>
            <th>Patrocionio</th>
            <th>Fecha de Registro</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($entrenadores as $entrenador)
            <tr>
                <th>{{$loop->iteration}}</th>
                <td>{{$entrenador->nombre.' '.$entrenador->apellidoPaterno.' '.$entrenador->apellidoMaterno}}</td>
                <td>{{$entrenador->patrocinio}}</td>
                <td>{{substr($entrenador->fechaRegistro,8,2)."/".substr($entrenador->fechaRegistro,5,2)."/".substr($entrenador->fechaRegistro,0,4)}}</td>
                <td><a href="/entrenadores/{{$entrenador->idEntrenador}}/edit">Editar</a></td>
                <td>
                <form action="/entrenadores/{{$entrenador->idEntrenador}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="btnCrearEntrenador">
        <a href="/entrenadores/create">Crear Entrenador</a>
    </div>
</body>
</html-->
@extends('layouts.app')

@section('content')

<h1>Listado de Entrenadores</h1>
    <table>
        <thead>
            <th></th>
            <th>Nombre</th>
            <th>Patrocionio</th>
            <th>Fecha de Registro</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($entrenadores as $entrenador)
            <tr>
                <th>{{$loop->iteration}}</th>
                <td>{{$entrenador->nombre.' '.$entrenador->apellidoPaterno.' '.$entrenador->apellidoMaterno}}</td>
                <td>{{$entrenador->patrocinio}}</td>
                <td>{{substr($entrenador->fechaRegistro,8,2)."/".substr($entrenador->fechaRegistro,5,2)."/".substr($entrenador->fechaRegistro,0,4)}}</td>
                <td><a href="/entrenadores/{{$entrenador->idEntrenador}}/edit">Editar</a></td>
                <td>
                <form action="/entrenadores/{{$entrenador->idEntrenador}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

        <div class="btnCrearEntrenador">
        <a href="/entrenadores/create">Crear Entrenador</a>
    </div>
    @endsection