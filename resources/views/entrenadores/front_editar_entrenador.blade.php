<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar entrenador</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        text-align: center;
    }
    h1{
        padding: 1em;
    }
    .Dato{
        width: 70%;
        margin: auto;
        padding: 1em;
    }
    .Dato > label{
        float: left;
        font-size: 1.3em;
    }
    .Dato > input{
        float: right;
        font-size: 1.3em;
        width: 70%;
        text-align: left;
    }
    .Dato > textarea{
        float: right;
        font-size: 1.3em;
        width: 70%;
        height: 5em;
        text-align: left;
    }
    .Boton{
        padding: 2em;
        margin: auto;
        margin-top: 4em;
    }
    .Boton > input{
        font-size: 1.2em;
    }
</style>
<body>
    <h1>Editar Entrenador</h1>
    <form action="/entrenadores/{{$entrenador->idEntrenador}}" method="post">
        @csrf
        @method('PUT')
        <div class="Dato">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="{{$entrenador->nombre}}" pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" title="El nombre solo pose letras, acentos, puntos y espacios (Maximo 50 caracteres)" required>    
        </div> 
        
        <div class="Dato">
            <label for="apellidoPaterno">Apellido Paterno: </label>
            <input type="text" name="apellidoPaterno" id="apellidoPaterno" value="{{$entrenador->apellidoPaterno}}" pattern="^[a-zA-ZñÑáéíóú]{0,50}$" title="El apellido paterno solo pose letras y acentos (Maximo 50 caracteres)" required>    
        </div> 
        
        <div class="Dato">
            <label for="apellidoMaterno">Apellido Materno: </label>
            <input type="text" name="apellidoMaterno" id="apellidoMaterno" value="{{$entrenador->apellidoMaterno}}" pattern="^[a-zA-ZñÑáéíóú]{0,50}$" title="El apellido materno solo pose letras y acentos (Maximo 50 caracteres)">    
        </div>

        <div class="Dato">
            <label for="fechaRegistro">Fecha de Registro:  </label>
            <input type="date" name="fechaRegistro" id="fechaRegistro" value="{{$entrenador->fechaRegistro}}" required>
        </div>

        <div class="Dato">
            <label for="patrocinio">Patrocinadores: </label>
            <textarea name="patrocinio" id="patrocinio">{{$entrenador->patrocinio}}</textarea>
        </div>

        <div class="Boton">
            <input type="submit" value="Editar">
        </div>
    </form>
</body>
</html>