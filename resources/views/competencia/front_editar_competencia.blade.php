<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Competencia</title>
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
    <h1>Editar Competencia</h1>
    <form action="{{ url('/home/competencias/'.$competencia->idCompetencia) }}" method="post">
        {{ csrf_field() }}  
        {{ method_field('PATCH') }}
        <div class="Dato">
            <label for="nombreCompetencia">Nombre de la competencia: </label>
            <input type="text" name="nombreCompetencia" id="nombreCompetencia" value="{{ $competencia->nombreCompetencia }}" maxlength="50" placeholder="Maximo 50 caracteres" required>    
        </div>

        <div class="Dato">
            <label for="periodo">Periodo: </label>
            <input name="periodo" id="periodo" value="{{ $competencia->periodo }}" maxlength="50" placeholder="Maximo 50 caracteres" required>   
        </div>
        
        <div class="Dato">
            <label for="estado">Estado de la competencia: </label>
            <input type="text" name="estado"  id="estado" value="{{ $estatus->estatus }}" readonly="readonly">
            <input type="text" name="idEstatus" id="idEstatus" value="1" readonly="readonly" hidden="true">  
           
        </div>
        

        <div class="Boton">
            <input type="submit" value="Enviar">
        </div>
    </form>
</body>
</html>