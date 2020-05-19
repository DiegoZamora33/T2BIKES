
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
<a type="button" class="btn btn-danger text-white mt-3" data-toggle="modal" data-target="#modalFin">Finalizar competencia</a>
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

<div class="text-center mt-2">
  <a type="button" href="#" class="border border-primary rounded p-1 superBoton text-center text-success" data-toggle="modal" data-target="#modalNewCarrera">
    <i class="align-middle fas fa-plus-circle" style="font-size: 20px;"></i>
    <label class="align-middle mt-2 text-muted" style="cursor: pointer;">Nueva carrera</label>
  </a>
</div>
<br>

  @foreach($carreras as $miCarrera)
    <div class="card text-center mt-5" style="color:white;">
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


<br><br><br>
<ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
  <li id="registrar-carrera" class="p-2">
    <a type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditCompetencia">Editar Competencia</a>
    <a type="button" class="btn btn-danger" data-toggle="modal" style="color:white;" data-target="#modalDeleteCompetencia">Eliminar Competencia</a>
  </li>
</ul>


    <div class="modal fade" id="modalEditCompetencia" tabindex="-1" role="dialog" aria-labelledby="modalEditCompetencia" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditCompetencia">Renombrar competencia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

           <form class="form-horizontal"  name="formulario" action="" onSubmit="updateCompetencia(); return false">
              <div class="modal-body">

                @foreach($competencia as $miCompetencia)
                  <label for="nuevaCompetencia">Nombre de la competencia</label>
                  <input required type="text" class="form-control" id="nuevaCompetencia" name="nuevaCompetencia" value="{{$miCompetencia->nombreCompetencia}}">

                  <div class="form-group mt-4">
                    <label for="periodoCompetencia">Periodo</label>
                    <input required type="text" class="form-control" id="periodoCompetencia" name="periodoCompetencia" value="{{$miCompetencia->periodo}}">
                  </div>
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



<div class="modal fade" id="modalNewCarrera" tabindex="-1" role="dialog" aria-labelledby="modalNewCarrera" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNewCarrera">Crear carrera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form-horizontal"  name="formulario" action="" onSubmit="enviarCarrera(); return false">
          <div class="modal-body">

              <label for="nombreCarrera">Nombre de la carrera</label>
              <input type="text" class="form-control" id="nombreCarrera" name="nombreCarrera" placeholder="Ej. Carrera 1" autofocus required>
              <div class="form-group mt-2">
                <label for="tipoCarrera">Tipo de Carrera</label>


                <select id="tipoCarrera" name="tipoCarrera" class="form-control">

                    @foreach($tiposCarreras as $miTipoCarrera)
                        <option value="{{$miTipoCarrera->idTipoCarrera}}" >{{$miTipoCarrera->tipoCarrera}}</option>
                    @endforeach

                </select>


                
              </div>

              <div class="form-group mt-4">
                  <a class="nav-link dropdown-toggle w-75 mx-auto" data-toggle="collapse" href="#newTipeCarrera" role="button" aria-expanded="false" aria-controls="newTipeCarrera">
                    Agregar un Nuevo Tipo de Carrera
                  </a>

                  <div class="collapse" id="newTipeCarrera">
                    <small id="emailHelp" class="form-text text-muted"> Si desea Agregar un Nuevo Tipo de Carrera, Esbribalo en la siguiente cuadro de texto y despues haga click en el boton con el simbolo</small>
                    <div class="container d-flex justify-content-center mt-2">
                      <div class="d-flex mx-auto ml-5">
                        <label for="newTipoCarrera">Nuevo Tipo de Carrera</label>
                        <input type="text" class="form-control ml-3" id="newTipoCarrera" name="newTipoCarrera" placeholder="Se agregará a la lista de Tipos de Carreras">
                        <button onclick="enviarTipoCarrera()" type="button" class="mt-2 align-middle text-primary fas fa-plus-circle ml-2" style="font-size: 17px;"></button>
                
                      </div>
                    </div>
                  </div>
                </div>

              <label class="mt-1" for="descripcionCarrera">Descripción de la carrera</label>
              <textarea type="text" rows="3" class="form-control" id="descripcionCarrera" name="descripcionCarrera"></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Guardar</button>
          </div>
      </form>


    </div>
  </div>
</div>


<div class="modal fade" id="modalFin" tabindex="-1" role="dialog" aria-labelledby="modalFin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFin">Finalizar competencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>El estátus cambiará a finalizado y ya no se podrán modificar los datos. Esta acción no se puede deshacer.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" onclick="finalizarCompetencia()" data-toggle="modal" data-target=".bd-example-modal-sm">Finalizar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDeleteCompetencia" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCompetencia" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDeleteCompetencia">Eliminar competencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Se perderán todos los datos relacionados con la competencia, incluyendo reportes. Esta acción no se puede deshacer.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" onclick="deleteCompetencia()" data-toggle="modal" data-target=".bd-example-modal-sm">Eliminar</button>
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
