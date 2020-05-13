

    @foreach($competencias as $miCompetencia)
      <div class="card text-center mt-2" style="color:white;">
        <div class="card-header bg-dark">
          {{ $miCompetencia['nombreCompetencia'] }}
        </div>
        <div class="card-body"  style="color:black;">
          
          <h6 class="card-text text-muted">Periodo: {{ $miCompetencia['periodo'] }}</h6>
          <h6 class="card-text text-muted">Status: {{ $miCompetencia['estatus'] }}</h6>
          <a onclick="getTour();" class="btn btn-primary text-white">Ver más</a>
        </div>
      </div>
      <br>
    @endforeach


    <ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
      <li id="registrar-entrenador" class="p-2">
        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCompet">Nueva competencia</a>
      </li>
    </ul>

    <div class="modal fade" id="modalCompet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear competencia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label for="inputAddress">Nombre de la competencia</label>
            <input type="text" class="form-control" id="" placeholder="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Guardar</button>
          </div>
        </div>
      </div>
    </div>
