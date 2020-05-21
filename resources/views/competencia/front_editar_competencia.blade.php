@if(Auth::check())
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
            <input type="text" name="idEstatus" id="idEstatus" value="{{ $competencia->idEstatus }}" readonly="readonly" hidden="true">  
           
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
