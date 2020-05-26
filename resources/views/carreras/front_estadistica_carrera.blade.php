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