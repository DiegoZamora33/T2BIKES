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