@extends('layouts.app')

@section('content')

<h1>Listado de Tipos de Carreras</h1>
    <table>
        <thead>
            <th></th>
            <th>Tipo de Carrera</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($tiposCarrera as $tipoCarrera)
            <tr>
                <th>{{$loop->iteration}}</th>
                <td>{{$tipoCarrera->tipoCarrera}}</td>
                <td><a href="/home/tiposcarrera/{{$tipoCarrera->idTipoCarrera}}/edit">Editar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

        <div class="btnCrearEntrenador">
        <a href="/home/tiposcarrera/create">Crear Nuevo Tipo</a>
    </div>
@endsection