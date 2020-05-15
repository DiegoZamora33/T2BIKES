

<div class="row">
  <div class="text-left col-md-2">
    <a onclick="getTourR()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
    <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
      <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
    </a>
  </div>

  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  <input type="hidden" name="_idCompetencia" id="idCompetencia" value="{{$competencia->idCompetencia}}">
  <h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">{{$competencia->nombreCompetencia}}</h3>
</div>



@foreach($carrera as $miCarrera)
  <input type="hidden" name="_idCarrera" id="idCarrera" value="{{$miCarrera->idCarrera}}">
  <h4>{{$miCarrera->nombreCarrera}}</h4>
  <h6>{{$miCarrera->descripcion}}</h6>
  <h6>Fecha de Registro: {{ substr(str_limit($miCarrera->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($miCarrera->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($miCarrera->created_at, $limit = 10, $end = " "),0,4) }}</h6>
@endforeach


<br>
<h4>Competidores</h4>
<p>Selecciona uno para asignarle o restarle puntos</p>
<table>
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
      <tr data-toggle="modal" onclick="dataCarreraCompetencia('{{$miParticipante->numeroCompetidor}} ')" data-target="#modalCarreraCompetidor">
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
              $out = $out."'".$miParticipanteG->nombre." ".$miParticipanteG->apellidoPaterno." ".$miParticipanteG->apellidoMaterno."',";
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

<div class="w-100">
<div class="justify-content-center mt-3 d-flex mx-auto">
  <button class="btn btn-primary btn-md" id="btn-cambiarGrafica-carrera" onclick="grafCarrera()">Cambiar a Grafica de Pastel</button>
  <button type="button" class="btn btn-warning ml-2">Descargar Reporte</button>
</div>
</div><br><br>

<a type="button" class="btn btn-danger" data-toggle="modal" style="color:white;" data-target="#modalCar"">Eliminar carrera</a>




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

<div class="modal fade" id="modalCar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar carrera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Se perderán todos los datos relacionados con la carrera. Esta acción no se puede deshacer.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-sm">Eliminar</button>
      </div>
    </div>
  </div>
</div>
