

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
<h5>Numero de Competidor: "{{ $competidor->numeroCompetidor }}"</h5>
<h5>Nombre: {{ $competidor->nombre }} {{ $competidor->apellidoPaterno }} {{ $competidor->apellidoMaterno }}</h5>

@if($entrenador != null)
  @foreach($entrenador as $miEntrenador)
    <h5>Entrenador: {{ $miEntrenador->nombre }} {{ $miEntrenador->apellidoPaterno }} {{ $miEntrenador->apellidoMaterno }}</h5>
    <h5>Tiempo de Entrenamiento: {{ $miEntrenador->mesesEntrenamiento }}</h5>
    <h5 class="text-muted"> De {{ $miEntrenador->fechaInicio }} a {{ $miEntrenador->fechaFin }}</h5>
  @endforeach
@else
  <h5 class="text-muted">**No tiene un entrenador Asigando a esta Competencia**</h5>
@endif

             	<div class="text-center mb-5">

                @foreach($competencia as $miCompetencia)

                <input type="hidden" name="_idCompetencia" value="{{ $miCompetencia->idCompetencia }}" id="idCompetencia">

                <div class="card text-center text-white mt-4">
                  <div class="card-header bg-dark" style="font-size: 150%">
                     {{ $miCompetencia->nombreCompetencia }}
                  </div>
                  <div class="card-body text-black">
                    <h5 class="text-muted">Puntaje Global: {{ $miCompetencia->puntajeGlobal}}</h5>
                    <h5 class="text-muted">Periodo: {{ $miCompetencia->periodo }}</h5>
                  </div>
                </div>
                @endforeach
                <br><br>
                <h4 class="text-danger">Haga click en una fila para sumar/restar puntos</h4><br>
                <table class="mx-auto">
                  <thead>
                    <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Llegada</th>
                      <th scope="col">Puntaje</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($carreras as $miCarrera)
                    <tr data-toggle="modal" data-target="#modalCarrera">
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
          <button type="button" class="btn btn-warning ml-2">Descargar Reporte</button>
        </div>
      </div>



              <div class="modal fade" id="modalCarrera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Asignar Puntos</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">


                      <label for="inputAddress">Puntos a asignar/restar:</label><br>
                      <input class="form-control w-25 mx-auto" type="number" value="0" min="-50" max="1000" step="1"/><br><br>
                      <label for="inputAddress">¿Terminó la carrera?</label><br>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning">En Curso</button>
                        <button type="button" class="btn btn-success">Si terminó</button>
                        <button type="button" class="btn btn-danger">No terminó</button>
                      </div><br><br>
                      <label for="inputAddress">Lugar de llegada</label><br>
                      <input class="form-control w-25 mx-auto" type="number" value="5" min="0" max="1000" step="1"/>
                    

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Asignar</button>
                    </div>
                  </div>
                </div>
              </div>