
@if(Auth::check())
      <div class="row">

      <div class="text-left col-md-2">
        <a id="{{ $competidor->numeroCompetidor }}" onclick="getComp(this)" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" name="_numeroCompetidor" value="{{ $competidor->numeroCompetidor }}" id="numeroCompetidor">


        <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
          <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
        </a>
      </div>

      <h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Estadisticas sobre la Competencia</h3>

      </div>
      <h5 id="miNumeroCompetidor">Numero de Competidor: "{{ $competidor->numeroCompetidor }}"</h5>
      <h5 id="miCompetidor">Nombre: {{ $competidor->nombre }} {{ $competidor->apellidoPaterno }} {{ $competidor->apellidoMaterno }}</h5>

      @if($entrenador != null)
        @foreach($entrenador as $miEntrenador)
          <input type="hidden" name="idEntrenador" id="idEntrenador" value="{{ $miEntrenador->idEntrenador}}">
          <h5 id="miEntrenador" class="mt-3">Entrenador: {{ $miEntrenador->nombre }} {{ $miEntrenador->apellidoPaterno }} {{ $miEntrenador->apellidoMaterno }}</h5>
          <h5 id="miMesesEntrenamiento">Tiempo de Entrenamiento: {{ $miEntrenador->mesesEntrenamiento }}</h5>
          <h5 id="miFechaEntrenamiento" class="text-muted"> De {{ $miEntrenador->fechaInicio }} a {{ $miEntrenador->fechaFin }}</h5>
         
         @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
             <button class="btn btn-danger btn-sm mt-0" data-toggle="modal" data-target="#modalQuitarEntrenador">Quitar Entrenador</button>
          @endif

        @endforeach
      @else

          <h5 class="mt-4 text-muted">**No tiene un entrenador Asigando a esta Competencia**</h5>
          @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
             <button class="btn btn-warning btn-sm mt-0" data-toggle="modal" data-target="#modalEntrenador">Asignar Entrenador</button>
          @endif

      @endif

      <div class="text-center mt-4">
        <button type="button" onclick="compStatPDF()" class="btn btn-warning">Descargar Reporte</button>
      </div>
            	<div class="text-center mt-5 mb-5">
                     @foreach($competencia as $miCompetencia)

                        <input type="hidden" name="_idCompetencia" value="{{ $miCompetencia->idCompetencia }}" id="idCompetencia">

                        <div id="miCajaCompetencia" class="card text-center text-white mt-4">
                          <div id="miCompetencia" class="card-header bg-dark" style="font-size: 150%">
                             {{ $miCompetencia->nombreCompetencia }}
                          </div>
                          <div class="card-body text-black">
                            <h5 id="miPuntajeGlobal" class="text-muted">Puntaje Global: {{ $miCompetencia->puntajeGlobal}}</h5>
                            <h5 id="miPeriodoCompetencia" class="text-muted">Periodo: {{ $miCompetencia->periodo }}</h5>
                          </div>
                        </div>

                      @endforeach
                      <br><br>
                      @if (Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
                        <h4 class="text-danger">Haga click en una fila para sumar/restar puntos</h4><br>
                      @endif
                      <table id="carrers"  class="mx-auto">
                        <thead>
                          <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Lugar de llegada</th>
                            <th scope="col">Puntaje</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach($carreras as $miCarrera)

                           @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
                            <tr onclick="dataCarrera('{{ $miCarrera->idCarrera }}')" data-toggle="modal" data-target="#modalCarrera" style="cursor: pointer;">
                           @else
                            <tr style="cursor: pointer;">
                           @endif
                              <td data-label="Nombre de la Carrera">{{ $miCarrera->nombreCarrera }}</td>
                              <td data-label="Lugar de llegada">{{ $miCarrera->lugarLlegada }}</td>
                              <td data-label="Puntaje">{{ $miCarrera->puntaje }}</td>
                              <td data-label="Status">{{ $miCarrera->estatus }}</td>
                            </tr>
                          @endforeach

                        </tbody>
                      </table>

                      <h4 class="mt-5">Grafica</h4>
                      <div id="contenedorGrafica-competidor">
      	                <canvas id="competidor-grafica-bar"></canvas>
                        <script>
                          var ctx = document.getElementById("competidor-grafica-bar").getContext("2d");
                          var myChart = new Chart(ctx, {
                            type: "bar",
                            data: {
                              labels:
                              <?php

                                $out = "";
                                foreach ($carreras as &$miCarrera) {
                                    $out = $out."'".$miCarrera->nombreCarrera."',";
                                }

                                echo "[".$out."]";

                              ?>,
                              datasets: [{
                                label: 'Puntos',
                                data:
                                <?php

                                  $out = "";
                                  foreach ($carreras as &$miCarrera) {
                                      $out = $out.$miCarrera->puntaje.",";
                                  }

                                  echo "[".$out."]";

                                ?>,
                                backgroundColor: [
                                  'rgb(66, 134, 244)',
                                  'rgb(100, 8, 75)',
                                  'rgb(200, 134, 244)',
                                  'rgb(247, 218, 19)'
                                ]
                              }]
                            },
                            options: {
                              scales: {
                                yAxes: [{
                                    ticks: {
                                      beginAtZero: true
                                    }
                                }]
                              }
                            }
                          });
                        </script>
                      </div>
                </div>

            <div class="w-100">
              <div class="justify-content-center mt-3 d-flex mx-auto">
                <button class="btn btn-primary btn-md" id="btn-cambiarGrafica-competidor" onclick="grafCompetidor()">
                Cambiar a Grafica de Pastel</button>
              </div>
            </div>

          @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
            <div class="modal fade" id="modalQuitarEntrenador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Quitar Entrenador</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Este Entrenador dejará de guiar al competidor a lo lardo de la competencia.      Puede volver asignar otro entrenador en el momento que guste.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-danger" onclick="quitarEntrenador()">Quitar</button>
                    </div>
                  </div>
                </div>
              </div>

                <div class="modal fade" id="modalEntrenador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Elija un Entrenador</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Puede asignar un entrenador a ente competidor durante la competencia</p>
                            <div class="mt-0 pt-0 text-muted align-top" style="font-size: 14px;">
                              Este entrenador solo guiara al competidor en esta Competencia
                            </div>
                            <select id="asignarEntrenador" name="asignarEntrenador" class="form-control mt-2">
                                <option value="0">Sin Asignar</option>

                                @foreach($allEntrenadores as $entrenador)
                                  <option value="{{ $entrenador->idEntrenador }}">{{ $entrenador->nombre }} {{ $entrenador->apellidoPaterno }} {{ $entrenador->apellidoMaterno }}</option>
                                @endforeach

                            </select>
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
                          <button type="button" class="btn btn-primary" onclick="asignarEntrenador()">Guardar</button>
                        </div>
                      </div>
                    </div>
                  </div>



                    <div class="modal fade" id="modalCarrera" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Asignar Puntos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">


                            <label for="puntajeCarrera">Puntos a asignar/restar:</label><br>
                            <input id="puntajeCarrera" name="puntajeCarrera" class="form-control w-25 mx-auto" type="number" min="-50" max="1000" step="1"/><br>
                            <label for="inputAddress">¿Terminó la carrera?</label><br>

                            <div id="contenedorStatus" class="btn-group" role="group" aria-label="Basic example">
                              <button onclick="clickStatus(this)" type="button" id="pendiente" class="btn btn-warning">Pendiente</button>
                              <button onclick="clickStatus(this)" type="button" id="siTermino" class="btn btn-success">Si terminó</button>
                              <button onclick="clickStatus(this)" type="button" id="noTermino" class="btn btn-danger">No terminó</button>
                            </div><br><br>

                            <label for="lugarLlegadaCarrera">Lugar de llegada</label><br>
                            <input id="lugarLlegadaCarrera" name="lugarLlegadaCarrera" class="form-control w-25 mx-auto" type="number" min="0" max="1000" step="1"/>

                            <input type="hidden" name="idCarrera" id="idCarrera" value="0">

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button onclick="enviarPuntajeCarrera()" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Asignar</button>
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