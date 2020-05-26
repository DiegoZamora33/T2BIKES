@if(Auth::check())
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
        <h3 id="nombreCompetencia" class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">{{$miCompetencia->nombreCompetencia}}</h3>
      </div>

      <h6 id="estatus">Estatus: {{$miCompetencia->estatus}}</h6>
      <h6 id="periodo">Periodo: {{$miCompetencia->periodo}}</h6>

      <h6 id="fechaRegistro">Fecha de Registro: {{ substr(str_limit($miCompetencia->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($miCompetencia->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($miCompetencia->created_at, $limit = 10, $end = " "),0,4) }}</h6>


        @foreach($numParticipantes as $totalParticipantes)
          <h6 id="inscritos">Competidores Inscritos: {{$totalParticipantes->inscritos}}</h6>
        @endforeach

        @foreach($numCarreras as $totalCarreras)
          <h6 id="totalCarreras">Carreras de la Competencia: {{$totalCarreras->carreras}}</h6>
        @endforeach


      <div class="text-center mt-3">
        <button type="button" class="btn btn-warning" onclick='competenciaALLPDF()' >Descargar Reporte</button>
      </div>

      @if ($miCompetencia->idEstatus == 2)
        @if(Auth::user()->idtipoUsuario == 1)
          <a type="button" class="btn btn-danger text-white mt-3" data-toggle="modal" data-target="#modalFin">Finalizar competencia</a>
        @endif
      @endif

      <br>

      @endforeach

      <p>Ver Estadisticas/Carreras</p>
      <input id="toggle-trigger" type="checkbox" checked data-toggle="toggle" data-on="Estadisticas" data-off="Carreras" data-onstyle="success" data-offstyle="info" onchange="miToggle()">

      <br>

        @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
          <button type="button" class="btn btn-info btn-sm mt-3" onclick='agregarQuitarCompe()' >Agregar/Quitar Competidores</button>
        @endif

      <br><br><br>

      <div id="miEstadistica" style="display: block;">
            <h4>Puntajes Globales de la Competecia</h4>
            <p>Ver más o menos participantes</p>

             <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[1]">
                              <span class="demo-icon icon-minus"></span>
                            </button>
                            </span>


                            @if($totalParticipantes->inscritos > 0)
                              @if($totalParticipantes->inscritos < 4)
                                <input type="text" id="miQuant" name="quant[1]" onchange="actualizaLista(this)" class="form-control input-number"   value="{{$totalParticipantes->inscritos}}"  min="1" max="{{$totalParticipantes->inscritos}}">
                              @else
                                <input type="text" id="miQuant" name="quant[1]" onchange="actualizaLista(this)" class="form-control input-number"   value="4"  min="1" max="{{$totalParticipantes->inscritos}}">
                              @endif

                            @else
                              <input type="text" id="miQuant" name="quant[1]" onchange="actualizaLista(this)" class="form-control input-number"   value="{{$totalParticipantes->inscritos}}"  min="0" max="{{$totalParticipantes->inscritos}}">

                            @endif

                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                              <span class="demo-icon icon-plus"></span>
                            </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-5"></div>
                </div>
              <br>




      <div id="contenedorEstadistica">
          <table id="carrers">
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
                </div>
          </div>
              <div class="w-100">
                <div class="justify-content-center mt-3 d-flex mx-auto">
                  <button class="btn btn-primary btn-md" id="btn-cambiarGrafica-competencia" onclick="grafCompetencia()">
                  Cambiar a Grafica de Pastel</button>
                </div>
              </div>
      </div>



      <div id="listaCarreras" style="display: none;">
            <h4>Listado de Carreras</h4>

            @if ($miCompetencia->idEstatus == 2)
              <div class="text-center mt-2">
                <a type="button" href="#" class="border border-primary rounded p-1 superBoton text-center text-success" data-toggle="modal" data-target="#modalNewCarrera">
                  <i class="align-middle fas fa-plus-circle" style="font-size: 20px;"></i>
                  <label class="align-middle mt-2 text-muted" style="cursor: pointer;">Nueva carrera</label>
                </a>
              </div>
              <br>
            @endif

            @foreach($carreras as $miCarrera)
              <div class="card text-center mt-1 mb-3" style="color:white;">
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
      </div>
      <br>


      <br><br><br>

      @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
          <ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
            <li id="registrar-carrera" class="p-2">
                <a type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditCompetencia">Editar Competencia</a>

               @if(Auth::user()->idtipoUsuario == 1)  
                 <a type="button" class="btn btn-danger" data-toggle="modal" style="color:white;" data-target="#modalDeleteCompetencia">Eliminar Competencia</a>
               @endif

            </li>
          </ul>
      @endif


      @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
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
                        <input required type="text" class="form-control" maxlength="50" id="nuevaCompetencia" name="nuevaCompetencia" value="{{$miCompetencia->nombreCompetencia}}">

                        <div class="form-group mt-4">
                          <label for="periodoCompetencia">Periodo</label>
                          <input required type="text" class="form-control" maxlength="50" id="periodoCompetencia" name="periodoCompetencia" value="{{$miCompetencia->periodo}}">
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
                    <input type="text" class="form-control" id="nombreCarrera" name="nombreCarrera"  maxlength="50" placeholder="Ej. Carrera 1" autofocus required>
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
                           <div class="alert alert-info mt-1" id="miAlert">
                                   Si desea Agregar un Nuevo Tipo de Carrera, Esbribalo en la siguiente cuadro de texto y despues haga click en el boton con el simbolo
                            </div>
                          <div class="container d-flex justify-content-center mt-2">
                            <div class="d-flex mx-auto ml-5">
                              <label for="newTipoCarrera">Nuevo Tipo de Carrera</label>
                              <input type="text"  maxlength="50" class="form-control ml-3" id="newTipoCarrera" name="newTipoCarrera" placeholder="Se agregará a la lista de Tipos de Carreras">
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
    @endif

    @if(Auth::user()->idtipoUsuario == 1)
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
              <p>El estátus cambiará a finalizado, ya no se podrán modificar los datos ni agregar nuevas carreras. Esta acción no se puede deshacer.</p>
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
    @endif

      <script type="text/javascript">
        $('.btn-number').click(function(e){
          e.preventDefault();

          fieldName = $(this).attr('data-field');
          type      = $(this).attr('data-type');
          var input = $("input[name='"+fieldName+"']");
          var currentVal = parseInt(input.val());
          if (!isNaN(currentVal)) {
              if(type == 'minus') {

                  if(currentVal > input.attr('min')) {
                      input.val(currentVal - 1).change();
                  }
                  if(parseInt(input.val()) == input.attr('min')) {
                      $(this).attr('disabled', true);
                  }

              } else if(type == 'plus') {

                  if(currentVal < input.attr('max')) {
                      input.val(currentVal + 1).change();
                  }
                  if(parseInt(input.val()) == input.attr('max')) {
                      $(this).attr('disabled', true);
                  }

              }
          } else {
              input.val(0);
          }
      });
      $('.input-number').focusin(function(){
         $(this).data('oldValue', $(this).val());
      });
      $('.input-number').change(function() {

          minValue =  parseInt($(this).attr('min'));
          maxValue =  parseInt($(this).attr('max'));
          valueCurrent = parseInt($(this).val());

          name = $(this).attr('name');
          if(valueCurrent >= minValue) {
              $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
          } else {
              alert('Sorry, the minimum value was reached');
              $(this).val($(this).data('oldValue'));
          }
          if(valueCurrent <= maxValue) {
              $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
          } else {
              alert('No puedes poner números negativos');
              $(this).val($(this).data('oldValue'));
          }


      });
      $(".input-number").keydown(function (e) {
              // Allow: backspace, delete, tab, escape, enter and .
              if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                   // Allow: Ctrl+A
                  (e.keyCode == 65 && e.ctrlKey === true) ||
                   // Allow: home, end, left, right
                  (e.keyCode >= 35 && e.keyCode <= 39)) {
                       // let it happen, don't do anything
                       return;
              }
              // Ensure that it is a number and stop the keypress
              if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                  e.preventDefault();
              }
          });
      </script> 
@else
  <h4>No tienes permisos para realizar esto... </h4>
      <h5>Serás Redirigido a la Pagina Principal</h5>
      <script type="text/javascript">
        setTimeout(
          function()
          { 
            window.location = "{{ url('/') }}";
          }, 
          2500);
      </script>
@endif