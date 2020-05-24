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
                        $out = $out."'".$miCompePuntaje->numeroCompetidor."',";
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