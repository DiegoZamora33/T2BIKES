<canvas id="competencia-grafica-pie"></canvas>
            <script>
              var ctx = document.getElementById("competencia-grafica-pie").getContext("2d");
              var myChart = new Chart(ctx, {
                type: "pie",
                data: {
                  labels: ['Carlos Castro Cázares', 'Brandon Rodriguez Molina', 'Diego Zamora Delgado'],
                  datasets: [{
                    label: 'Rendimiento',
                    data: [42, 36, 35],
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