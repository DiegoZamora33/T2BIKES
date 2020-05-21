@if(Auth::check())
    <h1>Agregar una Competencia</h1>
    <form action="/home/competencias" method="post">
        {{ csrf_field() }}
        <div class="Dato">
            <label for="nombreCompetencia">Nombre de la competencia: </label>
            <input type="text" name="nombreCompetencia" id="nombreCompetencia" maxlength="50" placeholder="Maximo 50 caracteres" required>    
        </div>

        <div class="Dato">
            <label for="periodo">Periodo: </label>
            <input name="periodo" id="periodo" maxlength="50" placeholder="Maximo 50 caracteres" required>   
        </div>
        
        <div class="Dato">
            <input type="text" name="idEstatus" id="idEstatus" value="1" readonly="readonly" hidden="true">  
           
        </div>
        

        <div class="Boton">
            <input type="submit" value="Enviar">
        </div>
    </form>
@else
  <h4>No tienes permisos para realizar esto... </h4>
      <h5>Serás Redirigido a la Pagina Principal</h5>
      <script type="text/javascript">
        setTimeout(
          function()
          { 
            window.location = "{{ url('/') }}";
          }, 
          2500);
      </script>
@endif