
@if(Auth::check())
      <?php  //Generar mi Array de Los que Entrena
          $arrNombres = array();
          $arrCompetencia = array();
          $arrMeses = array();
          $arrPeriodo = array();
          $totalComp = 0;

          foreach ($entrenamientos as &$aux) 
          {
            $arrNombres[] = $aux->nombre.' '.$aux->apellidoPaterno.' '.$aux->apellidoMaterno;
            $arrCompetencia[] = $aux->nombreCompetencia;
            $arrMeses[] = $aux->mesesEntrenamiento;
            $arrPeriodo[] = 'Del '.substr($aux->fechaInicio,8,2)."/".substr($aux->fechaInicio,5,2)."/".substr($aux->fechaInicio,0,4).' al '.substr($aux->fechaFin,8,2)."/".substr($aux->fechaFin,5,2)."/".substr($aux->fechaFin,0,4);
          }

          foreach ($total as &$auxT) 
          {
              $totalComp = $auxT->total;
          }
      ?>



    <div class="row">

    <div class="text-left col-md-2">
      <a onclick="entrenadores()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
      <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
        <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
      </a>
    </div>

    <input type="hidden" name="idEntrenador" value="{{ $entrenador->idEntrenador }}" id="idEntrenador">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">


    <h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Perfil del Entrenador</h3>

    </div>

    <h5 id="miEntrenador">Nombre: {{ $entrenador->nombre }} {{ $entrenador->apellidoPaterno }} {{ $entrenador->apellidoMaterno }}</h5>
    <h5 id="miFechaRegistro">Fecha de Registro: {{ substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),0,4) }}</h5>
    <h5>Patrocinadores:</h5>
    <h6 id="miPatrocinio" class="card-text mt-1 text-muted"> {{ $entrenador->patrocinio }}</h6>

    <div class="text-center mt-3">
      <button type="button" class="btn btn-warning" onclick='<?php echo "entreAllPDF(".json_encode($arrNombres).",".json_encode($arrCompetencia).",".json_encode($arrMeses).",".json_encode($arrPeriodo).",".$totalComp.")" ?>'>Descargar Reporte</button>
    </div><br><br>

    <br>

    @foreach($total as $miTotal)
      <h4>Entrena a {{ $miTotal->total }} Competidores</h4>
    @endforeach

    @foreach($entrenamientos as $entrenamiento)
      <div class="card text-center text-white mt-3">
        <div class="card-header bg-dark">
          <label class="my-auto"> {{ $entrenamiento->nombre }} {{ $entrenamiento->apellidoPaterno }} {{ $entrenamiento->apellidoMaterno }} en la Competencia "{{ $entrenamiento->nombreCompetencia }}"</label><br>
          <label class="my-auto">Durante {{$entrenamiento->mesesEntrenamiento}} Meses</label><br>
          <label class="my-auto">Del {{ substr($entrenamiento->fechaInicio,8,2)."/".substr($entrenamiento->fechaInicio,5,2)."/".substr($entrenamiento->fechaInicio,0,4)}} al {{ substr($entrenamiento->fechaFin,8,2)."/".substr($entrenamiento->fechaFin,5,2)."/".substr($entrenamiento->fechaFin,0,4)}}</label>
        </div>
      </div>
    @endforeach


    @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
      <ul class="d-flex align-items-end flex-column fixed-bottom text-white">
        <li id="registrar-entrenador" class="p-2">
          <a type="button" class="btn btn-warning" onclick="editEntre();">Editar datos</a>

           @if(Auth::user()->idtipoUsuario == 1)
              <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteEntrenador">Eliminar entrenador</a>
           @endif

        </li>
      </ul>

      @if(Auth::user()->idtipoUsuario == 1)
          <div class="modal fade" id="deleteEntrenador" tabindex="-1" role="dialog" aria-labelledby="deleteEntrenador" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteEntrenador">Eliminar entrenador</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Esta acción no se podrá deshacer, los competidores con este entrenador pasarán a no tener ninguno</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger" onclick="deleteEntrenador()">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
      @endif
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