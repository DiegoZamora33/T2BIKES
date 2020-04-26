@extends('layouts.app')

@section('content')

<h1>Listado de Carreras</h1>
    <table>
        <thead>
            <th></th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Competencia</th>
            <th>Tipo</th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($carreras as $carrera)
            <tr>
                <th>{{$loop->iteration}}</th>
                <td>{{$carrera['nombre']}}</td>
                <td>{{$carrera['descripcion']}}</td>
                <td>{{$carrera['competencia']}}</td>
                <td>{{$carrera['tipo']}}</td>
                <td><a href="/home/carreras/{{$carrera['idCarrera']}}/edit">Editar</a></td>
                <td>
                    <form action="/home/carreras/{{$carrera['idCarrera']}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Eliminar">
                    </form>
                </td>
                <td><a href="/home/carreras/{{$carrera['idCarrera']}}">Mostrar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

        <div class="btnCrearEntrenador">
        <a href="/home/carreras/create">Crear Nueva Carrera</a>
    </div>
@endsection