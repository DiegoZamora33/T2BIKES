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
    <h1>Agregar un Tipo de Carrera</h1>
    <form action="/home/tiposcarrera" method="post">
        {{ csrf_field() }}
        <div class="Dato">
            <label for="tipoCarrera">Nombre del tipo de carrera: </label>
            <input type="text" name="tipoCarrera" id="tipoCarrera" maxlength="50" placeholder="Maximo 50 caracteres" required>    
        </div class="Dato">
        
        <div class="Boton">
            <input type="submit" value="Enviar">
        </div>
    </form>
</body>
</html>