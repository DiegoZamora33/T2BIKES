
@foreach($competencia as $miCompetencia)
<div class="row">
  <div class="text-left col-md-2">
    <a onclick="competencias()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
    <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
      <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
    </a>
  </div>

  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  <input type="hidden" name="_idCompetencia" id="idCompetencia" value="{{$miCompetencia->idCompetencia}}">
  <h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">{{$miCompetencia->nombreCompetencia}}</h3>
</div>

<h6>Status: {{$miCompetencia->estatus}}</h6>
<h6>Periodo: {{$miCompetencia->periodo}}</h6>

<h6>Fecha de Registro: {{ substr(str_limit($miCompetencia->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($miCompetencia->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($miCompetencia->created_at, $limit = 10, $end = " "),0,4) }}</h6>


  @foreach($numParticipantes as $totalParticipantes)
    <h6>Competidores Inscritos: {{$totalParticipantes->inscritos}}</h6>
  @endforeach

  @foreach($numCarreras as $totalCarreras)
    <h6>Carreras de la Competencia: {{$totalCarreras->carreras}}</h6>
  @endforeach


<a href="reporte.pdf" download="reporte" class="btn btn-warning mt-3">Descargar reporte</a>
<br><br>
<h4>Puntajes Globales de la Competecia</h4>
<p>Deslice para ver más o menos participantes</p>
@endforeach



<div class="inputDiv">
  <div class="etiqueta"></div>
  <input type="range" min="0" max="50" autocomplete="off" id="input3">
</div>

<table>
  <thead>
    <tr>
      <th scope="col">Nombre completo</th>
      <th scope="col">Número de competidor</th>
      <th scope="col">Posición</th>
      <th scope="col">Puntaje global</th>
    </tr>
  </thead>
  <tbody>

    @foreach($puntajesGlobales as $puntajeCompetetidor)  
      <tr>
        <td data-label="Nombre">{{$puntajeCompetetidor->nombre}} {{$puntajeCompetetidor->apellidoPaterno}} {{$puntajeCompetetidor->apellidoMaterno}}</td>
        <td data-label="Núm. de competidor">{{$puntajeCompetetidor->numeroCompetidor}}</td>
        <td data-label="Posición">{{$loop->iteration}}</td>
        <td data-label="Puntaje global">{{$puntajeCompetetidor->puntajeGlobal}}</td>
      </tr>
    @endforeach

  </tbody>
</table>

<h4 class="mt-5">Grafica</h4>

          <div id="contenedorGrafica-competencia">
            <canvas id="competencia-grafica-bar"></canvas>
            <script>
              var ctx = document.getElementById("competencia-grafica-bar").getContext("2d");
              var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                  labels: 
                  <?php

                    $out = "";
                    foreach ($puntajesGlobales as &$miCompePuntaje) {
                        $out = $out."'".$miCompePuntaje->nombre." ".$miCompePuntaje->apellidoPaterno." ".$miCompePuntaje->apellidoMaterno."',";
                    }

                    echo "[".$out."]";

                  ?>,
                  datasets: [{
                    label: 'Rendimiento',
                    data:
                    <?php

                      $out = "";
                      foreach ($puntajesGlobales as &$miCompePuntaje) {
                          $out = $out.$miCompePuntaje->puntajeGlobal.",";
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
    <button class="btn btn-primary btn-md" id="btn-cambiarGrafica-competencia" onclick="grafCompetencia()">
    Cambiar a Grafica de Pastel</button>
  </div>
</div>




<br>
<h4 class="mt-3">Carreras</h4>


  @foreach($carreras as $miCarrera)
    <div class="card text-center" style="color:white;">
      <div class="card-header bg-dark">
        {{$miCarrera->nombreCarrera}}
      </div>
      <div class="card-body"  style="color:black;">
        <h6>{{$miCarrera->descripcion}}</h6>
        <p class="card-text">Tipo de Carrera: {{$miCarrera->tipoCarrera}}</p>
        <a id="{{$miCarrera->idCarrera}}"  style="color:white;" onclick="getCarrera(this);" class="btn btn-primary">Estadisticas</a>
      </div>
    </div>
  @endforeach

<br>



<a type="button" class="btn btn-danger" data-toggle="modal" style="color:white;" data-target="#modalFinalizada"">Eliminar competencia</a>
<br><br><br>
<ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
  <li id="registrar-carrera" class="p-2">
    <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalFin"">Finalizar competencia</a>
    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCarrera"">Nueva carrera</a>
  </li>
</ul>
<div class="modal fade" id="modalCarrera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear carrera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="inputAddress">Nombre de la carrera</label>
        <input type="text" class="form-control" id="" placeholder="Ej. Carrera 1">
        <div class="form-group mt-2">
          <label for="inputCity">Tipo de Carrera</label>
          <select class="form-control">
              <option>Sin Asignar</option>
              <option>Montaña</option>
              <option>Velocidad</option>
              <option>Terraceria</option>
          </select>
        </div>
        <label class="mt-2" for="inputAddress">Descripción de la carrera</label>
        <textarea type="text" rows="3" class="form-control" id="" placeholder="Ej. 10km"> </textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalFin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Finalizar competencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>El estátus cambiará a finalizado y ya no se podrán modificar los datos. Esta acción no se puede deshacer.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-sm">Finalizar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalFinalizada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar competencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Se perderán todos los datos relacionados con la competencia, incluyendo reportes. Esta acción no se puede deshacer.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-sm">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<script>
  var elInput = document.querySelector('#input');
  var elInput3 = document.querySelector('#input3');
if (elInput3) {
  var w = parseInt(window.getComputedStyle(elInput3, null).getPropertyValue('width'));

  // LA ETIQUETA 
  var etq = document.querySelector('.etiqueta');
  if (etq) {
    // el valor de la etiqueta
    etq.innerHTML = elInput3.value;

    // calcula la posición inicial de la etiqueta
    var pxls = w / 50;

    etq.style.left = ((elInput3.value * pxls) - 15) + 'px';

    elInput3.addEventListener('input', function() {
      // cambia el valor de la etiqueta
      etq.innerHTML = elInput3.value;
      // cambia la posición de la etiqueta 
      etq.style.left = ((elInput3.value * pxls) - 15) + 'px';

    }, false);
  }
}
</script>
