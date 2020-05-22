
@if(Auth::check())
      <?php  //Generar mi Array de Competencias
          $arrNombres = array();
          $arrPuntaje = array();
          $arrPeriodo = array();
          $arrEstatus = array();
          $arrEntrenador = array();

          foreach ($competencias as &$aux) 
          {
            $arrNombres[] = $aux->nombreCompetencia;
            $arrPuntaje[] = $aux->puntajeGlobal;
            $arrPeriodo[] = $aux->periodo;
            $arrEstatus[] = $aux->estatus;

            $select = DB::select(" SELECT entrenadors.idEntrenador, entrenadors.nombre, entrenadors.apellidoPaterno, entrenadors.apellidoMaterno, mesesEntrenamiento, fechaInicio, fechaFin
                      FROM entrenador__competidor__competencias INNER JOIN entrenadors 
                      ON entrenador__competidor__competencias.idEntrenador = entrenadors.idEntrenador
                      WHERE entrenador__competidor__competencias.numeroCompetidor = ".$competidor->numeroCompetidor."       AND entrenador__competidor__competencias.idCompetencia = ".$aux->idCompetencia);

            if($select != null)
            {
              $arrEntrenador[] = $select[0]->nombre." ".$select[0]->apellidoPaterno." ".$select[0]->apellidoMaterno;
            }
            else
            {
              $arrEntrenador[] = "No tiene un Entrenador en esta Competencia";
            }

          }
      ?>

      <div class="row">

      <div class="text-left col-md-2">
        <a onclick="competidores()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
        <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
          <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
        </a>
      </div>

      <h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Perfil del Competidor</h3>

      </div>

      <h3 id="miNumeroCompetidor">"{{ $competidor->numeroCompetidor }}"</h3>
      <input type="hidden" name="_numeroCompetidor" value="{{ $competidor->numeroCompetidor }}" id="_numeroCompetidor">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
      <input type="hidden" id="{{ $competidor->numeroCompetidor }}">
      <h5 id="miCompetidor">Nombre: {{ $competidor->nombre }} {{ $competidor->apellidoPaterno }} {{ $competidor->apellidoMaterno }}</h5>
      <h5 id="miFechaRegistro">Fecha de Registro: {{ substr(str_limit($competidor->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($competidor->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($competidor->created_at, $limit = 10, $end = " "),0,4) }}</h5>



      <div class="text-center mt-3">
        <button type="button" class="btn btn-warning" onclick='<?php echo "compAllPDF(".json_encode($arrNombres).",".json_encode($arrPuntaje).",".json_encode($arrPeriodo).",".json_encode($arrEstatus).",".json_encode($arrEntrenador).")" ?>' >Descargar Reporte</button>
      </div><br><br>

      <h3 class="font-weight-bold">Competencias</h3>

      @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
        <div class="text-center mt-5">
          <a type="button" href="#" class="border border-primary rounded p-1 superBoton text-center text-success" data-toggle="modal" data-target="#modalAsignarCompe">
            <i class="align-middle fas fa-plus-circle" style="font-size: 20px;"></i>
            <label class="align-middle mt-2 text-muted" style="cursor: pointer;">Asignar Competencia</label>
          </a>
        </div>
      @endif

      @foreach( $competencias as $miCompetencia )
      <div class="card text-center text-white mt-4">
        <div class="card-header bg-dark">
         {{ $miCompetencia->nombreCompetencia }}
        </div>
        <div class="card-body text-black">
          <h5 class="card-text text-muted">Puntaje global: {{ $miCompetencia->puntajeGlobal }} puntos</h5>
          <h6 class="card-text mt-1 text-muted">"Periodo: {{ $miCompetencia->periodo }}"</h6>
          <h6 class="card-text mt-1 text-muted">"{{ $miCompetencia->estatus }}"</h6>
          <a id="{{ $miCompetencia->idCompetencia }}" style="color:white;" onclick="getStat(this);" class="btn btn-primary mt-2">Ver estadísticas</a>

          @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
             <a id="{{ $miCompetencia->idCompetencia }}" style="color:white;" class="btn btn-danger mt-2" data-toggle="modal" data-target="#modalQuitarCompetencia" onclick="quitaEstaCompe(this);" >Quitar Competencia</a>
          @endif
        </div>
      </div>
      @endforeach

      @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
        <ul class="d-flex align-items-end flex-column fixed-bottom text-white">
          <li id="registrar-entrenador" class="p-2">
            <a type="button" class="btn btn-warning" onclick="editComp();">Editar datos</a>

             @if(Auth::user()->idtipoUsuario == 1)
                 <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCompetidor">Eliminar competidor</a>
              @endif
          </li>
        </ul>


      <br><br><br>


      <div class="modal fade" id="modalQuitarCompetencia" tabindex="-1" role="dialog" aria-labelledby="modalQuitarCompetencia" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalQuitarCompetencia">Quitar Competencia</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Esta acción no se podrá deshacer, La competencia y carreras en las que este competidor participó se perderan.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-danger" onclick="quitarCompcia();">Quitar</button>
            </div>
          </div>
        </div>
      </div>


      @if(Auth::user()->idtipoUsuario == 1)
          <div class="modal fade" id="deleteCompetidor" tabindex="-1" role="dialog" aria-labelledby="deleteCompetidor" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteCompetidor">Eliminar competidor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Esta acción no se podrá deshacer, todas las estadisticas y reportes se perderán</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger" onclick="eliminarCompetidor()">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
      @endif



      <div class="modal fade" id="modalAsignarCompe" tabindex="-1" role="dialog" aria-labelledby="modalAsignarCompe" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAsignarCompe">Asignar competencia</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

              <input type="hidden" name="_token" value="{{ csrf_token() }}" id="tokenAsignar">

              <div class="alert alert-info mb-0 mt-4" id="miAlert">
                Primero seleccione una Competencia.
              </div>
                     
                <div class="modal-body mt-1">
                  <div class="form-group">
                    <label for="asignarCompetencia">Competencia</label>
                    <select id="asignarCompetencia" name="asignarCompetencia" class="form-control">
                        <option value="0">Sin Asignar</option>

                        @foreach($allCompetencias as $competencia)
                          <option value="{{ $competencia->idCompetencia }}">{{ $competencia->nombreCompetencia }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">

                    <div class="m-0 p-0">
                      Entrenador
                    </div>
                    <div class="mt-0 pt-0 text-muted align-top" style="font-size: 14px;">
                      Este entrenador solo guiara al competidor en esta Competencia
                    </div>
                    <select id="asignarEntrenador" name="asignarEntrenador" class="form-control mt-2">
                        <option value="0">Sin Asignar</option>

                        @foreach($allEntrenadores as $entrenador)
                          <option value="{{ $entrenador->idEntrenador }}">{{ $entrenador->nombre }} {{ $entrenador->apellidoPaterno }} {{ $entrenador->apellidoMaterno }}</option>
                        @endforeach

                    </select>
                  </div>

                  <div class="container d-flex justify-content-center">
                    <div class="col-md-8">
                      <label for="mesesEntrenamiento">Tiempo de Entrenamiento</label>
                      <div class="d-flex w-50 mx-auto">
                        <input type="number" class="form-control" id="mesesEntrenamiento" name="mesesEntrenamiento" min="0" max="18" value="0">
                        <label class="mt-auto ml-3">Meses</label>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" onclick="asignarCompetencia()">Guardar</button>
                </div>

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