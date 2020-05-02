

<div class="row">

<div class="text-left col-md-2">
  <a onclick="competidores()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
  <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
    <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
  </a>
</div>

<h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Perfil del Competidor</h3>

</div>

<h3>"{{ $competidor->numeroCompetidor }}"</h3>
<input type="hidden" name="_numeroCompetidor" value="{{ $competidor->numeroCompetidor }}" id="_numeroCompetidor">
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<input type="hidden" id="{{ $competidor->numeroCompetidor }}">
<h5>Nombre: {{ $competidor->nombre }} {{ $competidor->apellidoPaterno }} {{ $competidor->apellidoMaterno }}</h5>
<h5>Fecha de Registro: {{ str_limit($competidor->created_at, $limit = 10, $end = " ") }}</h5>



<div class="text-center mt-3">
  <button type="button" class="btn btn-warning">Descargar Reporte</button>
</div><br><br>

<h3 class="font-weight-bold">Competencias</h3>

@foreach( $competencias as $miCompetencia )
<div class="card text-center text-white mt-4">
  <div class="card-header bg-dark">
   {{ $miCompetencia->nombreCompetencia }}
  </div>
  <div class="card-body text-black">
    <h5 class="card-text text-muted">Puntaje global: {{ $miCompetencia->puntajeGlobal }} puntos</h5>
    <h6 class="card-text mt-1 text-muted">"Periodo: {{ $miCompetencia->periodo }}"</h6>
    <h6 class="card-text mt-1 text-muted">"{{ $miCompetencia->estatus }}"</h6>
    <a id="{{ $miCompetencia->idCompetencia }}" style="color:white;" onclick="getStat(this);" class="btn btn-primary mt-4">Ver estadísticas</a>
  </div>
</div>
@endforeach


<div class="text-center mt-5">
  <a type="button" href="#" class="border border-primary rounded p-1 superBoton text-center text-success" data-toggle="modal" data-target="#exampleModal2">
    <i class="align-middle fas fa-plus-circle" style="font-size: 20px;"></i>
    <label class="align-middle mt-2 text-muted" style="cursor: pointer;">Asignar Competencia</label>
  </a>
</div>

<ul class="d-flex align-items-end flex-column fixed-bottom text-white">
  <li id="registrar-entrenador" class="p-2">
    <a type="button" class="btn btn-warning" onclick="editComp();">Editar datos</a>
    <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar competidor</a>
  </li>
</ul>
<br><br><br>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar competidor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Esta acción no se podrá deshacer, todas las estadisticas y reportes se perderán</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar competencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form-horizontal"  name="formularioAsignar" action="" onSubmit="asignarCompetencia(); return false">

          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="tokenAsignar">
          
          <div class="modal-body">
            <div class="form-group">
              <label for="asignarCompetencia">Competencia</label>
              <select id="asignarCompetencia" name="asignarCompetencia" class="form-control">
                  <option value="0">Sin Asignar</option>

                  @foreach($allCompetencias as $competencia)
                    <option value="{{ $competencia->idCompetencia }}">{{ $competencia->nombreCompetencia }}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">

              <div class="m-0 p-0">
                Entrenador
              </div>
              <div class="mt-0 pt-0 text-muted align-top" style="font-size: 14px;">
                Este entrenador solo guiara al competidor en esta Competencia
              </div>
              <select id="asignarEntrenador" name="asignarEntrenador" class="form-control mt-2">
                  <option value="0">Sin Asignar</option>

                  @foreach($allEntrenadores as $entrenador)
                    <option value="{{ $entrenador->idEntrenador }}">{{ $entrenador->nombre }} {{ $entrenador->apellidoPaterno }} {{ $entrenador->apellidoMaterno }}</option>
                  @endforeach

              </select>
            </div>

            <div class="container d-flex justify-content-center">
              <div class="col-md-8">
                <label for="mesesEntrenamiento">Tiempo de Entrenamiento</label>
                <div class="d-flex w-50 mx-auto">
                  <input type="number" class="form-control" id="mesesEntrenamiento" name="mesesEntrenamiento" min="0" max="18" value="0">
                  <label class="mt-auto ml-3">Meses</label>
                </div>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" data-toggle="modal">Guardar</button>
          </div>
      </form>

    </div>
  </div>
</div>
