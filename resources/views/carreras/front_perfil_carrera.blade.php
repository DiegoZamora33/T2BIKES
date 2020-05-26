
@if(Auth::check())
    <div class="row">
      <div class="text-left col-md-2">
        <a onclick="getTourR()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
        <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
          <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
        </a>
      </div>

      <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
      <input type="hidden" name="_idCompetencia" id="idCompetencia" value="{{$competencia->idCompetencia}}">
      <h3 id="nombreCompetencia" class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">{{$competencia->nombreCompetencia}}</h3>
    </div>


    @foreach($carrera as $miCarrera)
      <input type="hidden" name="_idCarrera" id="idCarrera" value="{{$miCarrera->idCarrera}}">
      <h4 id="nombreCarrera">{{$miCarrera->nombreCarrera}}</h4>
      <h6 id="descripcion">{{$miCarrera->descripcion}}</h6>
      <h6 id="fechaRegistro">Fecha de Registro: {{ substr(str_limit($miCarrera->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($miCarrera->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($miCarrera->created_at, $limit = 10, $end = " "),0,4) }}</h6>
    @endforeach
    @foreach($numParticipantes as $totalParticipantes)
      <h6 id="inscritos">Competidores Inscritos: {{$totalParticipantes->inscritos}}</h6>
    @endforeach


    <button type="button" onclick="carreraALLPDF()" class="btn btn-warning ml-2">Descargar Reporte</button>

    <br>
    <h4 class="mt-4">Competidores</h4>



             <p>Ver más o menos participantes</p>

             <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" data-type="minus" onclick="less()">
                              <span class="demo-icon icon-minus"></span>
                            </button>
                            </span>


                            @if($totalParticipantes->inscritos > 0)
                              @if($totalParticipantes->inscritos < 4)
                                <input type="text" id="g" onchange="actualizaListaCarrera(this)" class="form-control input-number"   value="{{$totalParticipantes->inscritos}}"  min="1" max="{{$totalParticipantes->inscritos}}">
                              @else
                                <input type="text" id="g" onchange="actualizaListaCarrera(this)" class="form-control input-number"   value="4"  min="1" max="{{$totalParticipantes->inscritos}}">
                              @endif

                            @else
                              <input type="text" id="g" onchange="actualizaListaCarrera(this)" class="form-control input-number"   value="{{$totalParticipantes->inscritos}}"  min="0" max="{{$totalParticipantes->inscritos}}">

                            @endif

                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" data-type="plus" onclick="plus()">
                              <span class="demo-icon icon-plus"></span>
                            </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-5"></div>
                </div>
              <br>


    @if (Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
      <p>Selecciona uno para asignarle o restarle puntos</p>
    @endif

    <div id="contenedorEstadistica">
          <table id="carrers">
            <thead>
              <tr>
                <th scope="col">Nombre completo</th>
                <th scope="col">Número de competidor</th>
                <th scope="col">Posición</th>
                <th scope="col">Puntaje</th>
              </tr>
            </thead>
            <tbody>

              @foreach($participantes as $miParticipante)
                @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
                    <tr data-toggle="modal" onclick="dataCarreraCompetencia('{{$miParticipante->numeroCompetidor}} ')" data-target="#modalCarreraCompetidor" style="cursor: pointer;">
                @else
                    <tr style="cursor: pointer;">
                @endif
                      <td data-label="Nombre">{{$miParticipante->nombre}} {{$miParticipante->apellidoPaterno}} {{$miParticipante->apellidoMaterno}}</td>
                      <td data-label="Núm. de competidor">{{$miParticipante->numeroCompetidor}}</td>
                      <td data-label="Posición">{{$miParticipante->lugarLlegada}}</td>
                      <td data-label="Puntaje">{{$miParticipante->puntaje}}</td>
                    </tr>
              @endforeach

            </tbody>
          </table><br>


          <h4 class="mt-5">Grafica</h4>
          <div id="contenedorGrafica-carrera">
            <canvas id="carrera-grafica-bar"></canvas>
            <script>
              var ctx = document.getElementById("carrera-grafica-bar").getContext("2d");
              var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                  labels: 
                  <?php

                    $out = "";
                    foreach ($participantes as &$miParticipanteG) {
                        $out = $out."'".$miParticipanteG->numeroCompetidor."',";
                    }

                    echo "[".$out."]";

                  ?>,
                  datasets: [{
                    label: 'Puntaje',
                    data: 
                    <?php

                      $out = "";
                      foreach ($participantes as &$miParticipanteG) {
                          $out = $out.$miParticipanteG->puntaje.",";
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
    </div>

    <div class="w-100">
    <div class="justify-content-center mt-3 d-flex mx-auto">
      <button class="btn btn-primary btn-md" id="btn-cambiarGrafica-carrera" onclick="grafCarrera()">Cambiar a Grafica de Pastel</button>
    </div>
    </div><br><br>



    <br><br><br>
    @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
        <ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
          <li id="registrar-carrera" class="p-2">
            <a type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditCarrera">Editar Carrera</a>

            @if(Auth::user()->idtipoUsuario == 1)
                <a type="button" class="btn btn-danger" data-toggle="modal" style="color:white;" data-target="#modalDelCarrera">Eliminar Carrera</a>
            @endif
          </li>
        </ul>
    @endif



    <div class="modal fade" id="modalEditCarrera" tabindex="-1" role="dialog" aria-labelledby="modalEditCarrera" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditCarrera">Crear carrera</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form class="form-horizontal"  name="formulario" action="" onSubmit="updateCarrera(); return false">
              <div class="modal-body">

                @foreach($carrera as $miCarrera)
                  <label for="nombreCarrera">Nombre de la carrera</label>
                  <input required type="text" class="form-control" id="nombreCarrera" name="nombreCarrera" value="{{$miCarrera->nombreCarrera}}">
                  <div class="form-group mt-2">
                    <label for="tipoCarrera">Tipo de Carrera</label>
                    <select id="tipoCarrera" name="tipoCarrera" class="form-control">
                        <option value="{{$miCarrera->idTipoCarrera}}">{{$miCarrera->tipoCarrera}}</option>

                        @foreach($tiposCarreras as $miTipoCarrera)
                          @if($miTipoCarrera->idTipoCarrera != $miCarrera->idTipoCarrera)
                            <option value="{{$miTipoCarrera->idTipoCarrera}}" >{{$miTipoCarrera->tipoCarrera}}</option>
                          @endif
                        @endforeach

                    </select>
                  </div>
                  <label class="mt-2" for="descripcionCarrera">Descripción de la carrera</label>
                  <textarea type="text" rows="3" class="form-control" id="descripcionCarrera" name="descripcionCarrera">{{$miCarrera->descripcion}}</textarea>
                @endforeach

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Guardar</button>
              </div>
          </form>

        </div>
      </div>
    </div>



    <div class="modal fade" id="modalCarreraCompetidor" tabindex="-1" role="dialog" aria-labelledby="modalCarreraCompetidor" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCarreraCompetidor">Asignar Puntos</h5>
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

              <input type="hidden" name="numeroCompetidor" id="numeroCompetidor" value="0">



            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" onclick="enviarPuntajeCarreraComp()" data-target=".bd-example-modal-sm">Asignar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalDelCarrera" tabindex="-1" role="dialog" aria-labelledby="modalDelCarrera" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDelCarrera">Eliminar carrera</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Se perderán todos los datos relacionados con la carrera. Esta acción no se puede deshacer.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" onclick="deleteCarrera()" data-toggle="modal" data-target=".bd-example-modal-sm">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
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