<script src=" {{ asset('t2bikes\js\jquery-3.4.1.min.js') }}"></script>

<div class="Contenido">

</div>

<h1>Agregar un Competidor</h1>
<form action="/home/competidores" method="post" id="registrarCompetidor">
    {{ csrf_field() }}
    <div class="Dato">
        <label for="numeroCompetidor">Numero de Competidor: </label>
        <input type="text" name="numeroCompetidor" id="numeroCompetidor" pattern="^[0-9A-Z]{0,10}$" title="El numero de competidor solo pose numeros y letras mayusculas (Maximo 10 caracteres)" required>    
    </div class="Dato">
    
    <div class="Dato">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" title="El nombre solo pose letras, acentos, puntos y espacios (Maximo 50 caracteres)" required>    
    </div class="Dato"> 
    
    <div class="Dato">
        <label for="apellidoPaterno">Apellido Paterno: </label>
        <input type="text" name="apellidoPaterno" id="apellidoPaterno" pattern="^[a-zA-ZñÑáéíóú]{0,50}$" title="El apellido paterno solo pose letras y acentos (Maximo 50 caracteres)" required>    
    </div class="Dato"> 
    
    <div class="Dato">
        <label for="apellidoMaterno">Apellido Materno: </label>
        <input type="text" name="apellidoMaterno" id="apellidoMaterno" pattern="^[a-zA-ZñÑáéíóú]{0,50}$" title="El apellido materno solo pose letras y acentos (Maximo 50 caracteres)">    
    </div class="Dato"> 
    
    <div class="Dato">
        <label for="fechaRegistro">Fecha de Registro:  </label>
        <input type="date" name="fechaRegistro" id="fechaRegistro" value="{{date('Y-m-d')}}" required>
    </div>

    <div class="Boton">
        <input type="submit" value="Enviar">
    </div>
</form>

<script>
    /* const url = 'http://localhost/T2BIKES/public';  */
    const url = 'http://localhost:8000';
    
    function mostrarCompetidores() {
        $.ajax({
            type: "get",
            url: url+"/home/competidores",
            data: {},
            dataType: "html",
            success: function (response) {
                $('.Contenido').html(response);

                $('.eliminarCompetidor').submit(function (e) { 
                    e.preventDefault();

                    var parametros = {
                        '_token':$('input:hidden[name=_token]', this).val(),
                        '_method':$('input:hidden[name=_method]', this).val()
                    };

                    $.ajax({
                        type: "post",
                        url: url+"/home/competidores/"+$('#numeroCompetidor', this).val(),
                        data: parametros,
                        dataType: "text",
                        success: function (response) {
                            alert(response);
                            mostrarCompetidores();
                        }
                    });
                });
            }
        });
    }

    mostrarCompetidores();

    $('#registrarCompetidor').submit(function (e) { 
        e.preventDefault();
        
        var parametros = {
            '_token':$('#registrarCompetidor input:hidden[name=_token]').val(),
            'numeroCompetidor':$('#registrarCompetidor #numeroCompetidor').val(),
            'nombre':$('#registrarCompetidor #nombre').val(),
            'apellidoPaterno':$('#registrarCompetidor #apellidoPaterno').val(),
            'apellidoMaterno':$('#registrarCompetidor #apellidoMaterno').val(),
            'fechaRegistro':$('#registrarCompetidor #fechaRegistro').val()
        };
        
        console.log(parametros);
        
        $.ajax({
            type: "post",
            url: url+"/home/competidores",
            data: parametros,
            dataType: "text",
            success: function (response) {
                alert(response);
                mostrarCompetidores();
            }
        });
    });
    
</script>