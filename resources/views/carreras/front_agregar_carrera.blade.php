<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Entrenador</title>
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
        padding: 3em;
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
    <h1>Agregar una Carrera</h1>
    <form action="/home/carreras" method="post">
        {{ csrf_field() }}
        <div class="Dato">
            <label for="nombreCarrera">Nombre del tipo de carrera: </label>
            <input type="text" name="nombreCarrera" id="nombreCarrera" maxlength="50" placeholder="Maximo 50 caracteres" required>    
        </div>

        <div class="Dato">
            <label for="descripcion">Descripcion: </label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>   
        </div>
        
        <div class="Dato">
            <label for="idCompetencia">Competencia: </label>
            <select name="idCompetencia" id="idCompetencia" required>
                @foreach ($competencias as $competencia)
                    <option value="{{$competencia->idCompetencia}}">{{$competencia->nombreCompetencia}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="Dato">
            <label for="idTipoCarrera">Tipo: </label>
            <select name="idTipoCarrera" id="idTipoCarrera" required>
                @foreach ($tiposCarrera as $tipoCarrera)
                    <option value="{{$tipoCarrera->idtipoCarrera}}">{{$tipoCarrera->tipoCarrera}}</option>
                @endforeach
            </select>
        </div>

        <div class="Boton">
            <input type="submit" value="Enviar">
        </div>
    </form>
</body>
</html>