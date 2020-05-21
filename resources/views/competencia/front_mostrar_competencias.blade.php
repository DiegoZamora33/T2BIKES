@if(Auth::check())
    <h3>Competencias Registradas</h2> </h3>
    <br>
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

        @foreach($competencias as $miCompetencia)
          <div class="card text-center mt-2 " style="color:white;">
            <div class="card-header bg-dark">
              {{ $miCompetencia['nombreCompetencia'] }}
            </div>
            <div class="card-body"  style="color:black;">

              <?php
               $query= DB::select("SELECT COUNT(*) inscritos FROM competencias
                       INNER JOIN puntaje__competidor__competencias
                        ON competencias.idCompetencia = puntaje__competidor__competencias.idCompetencia
                        WHERE puntaje__competidor__competencias.idCompetencia = ".$miCompetencia['idCompetencia']."");      
              ?>
             @foreach($query as $miQuery)
              <h5 class="card-title"> Participantes: {{ $miQuery->inscritos }} </h5>
             @endforeach
              <h6 class="card-text text-muted">Periodo: {{ $miCompetencia['periodo'] }}</h6>
              <h6 class="card-text text-muted">Estatus: {{ $miCompetencia['estatus'] }}</h6>
              <a id="{{ $miCompetencia['idCompetencia'] }}" onclick="getTour(this);" class="btn btn-primary text-white">Ver más</a>
            </div>
          </div>
          <br>
        @endforeach

        @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
          <ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
            <li id="registrar-entrenador" class="p-2">
              <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCompet">Nueva competencia</a>
            </li>
          </ul>


          <div class="modal fade" id="modalCompet" tabindex="-1" role="dialog" aria-labelledby="modalCompet" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalCompet">Crear competencia</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <form class="form-horizontal"  name="formulario" action="" onSubmit="enviarCompetencia(); return false">
                    <div class="modal-body">

                        <label for="nuevaCompetencia">Nombre de la competencia</label>
                        <input required autofocus type="text" class="form-control" id="nuevaCompetencia" maxlength='50' name="nuevaCompetencia" placeholder="">

                        <div class="form-group mt-4">
                          <label for="periodoCompetencia">Periodo</label>
                          <input required type="text" class="form-control" id="periodoCompetencia"  maxlength='50' name="periodoCompetencia" placeholder="Ej: Enero - Junio 2020">
                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Guardar</button>
                    </div>
                 </form>
              </div>
            </div>
          </div>
        @endif
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