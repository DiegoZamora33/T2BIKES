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