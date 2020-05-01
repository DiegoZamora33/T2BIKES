  <canvas id="carrera-grafica-pie"></canvas>
  <script>
    var ctx = document.getElementById("carrera-grafica-pie").getContext("2d");
    var myChart = new Chart(ctx, {
      type: "pie",
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
          label: 'Puntaje',
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