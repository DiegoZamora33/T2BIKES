

<div class="row">

<div class="text-left col-md-2">
  <a onclick="entrenadores()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
  <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
    <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
  </a>
</div>

<h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Perfil del Entrenador</h3>

</div>

<h5>Nombre: {{ $entrenador->nombre }} {{ $entrenador->apellidoPaterno }} {{ $entrenador->apellidoMaterno }}</h5>
<h5>Fecha de Registro: {{ substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),0,4) }}</h5>
<h5>Patrocinadores:</h5>
<h6 class="card-text mt-1 text-muted"> {{ $entrenador->patrocinio }}</h6>

<div class="text-center mt-3">
  <button type="button" class="btn btn-warning">Descargar Reporte</button>
</div><br><br>

<br>
<h4>Entrena a 2 Competidores</h4>

@foreach($entrenamientos as $entrenamiento)
  <div class="card text-center text-white mt-3">
    <div class="card-header bg-dark">
      <label class="my-auto"> {{ $entrenamiento->nombre }} {{ $entrenamiento->apellidoPaterno }} {{ $entrenamiento->apellidoMaterno }} en la Competencia "{{ $entrenamiento->nombreCompetencia }}"</label><br>
      <label class="my-auto">Durante {{$entrenamiento->mesesEntrenamiento}} Meses</label><br>
      <label class="my-auto">De {{$entrenamiento->fechaInicio}} a {{$entrenamiento->fechaFin}}</label>
    </div>
  </div>
@endforeach

<ul class="d-flex align-items-end flex-column fixed-bottom text-white">
  <li id="registrar-entrenador" class="p-2">
    <a type="button" class="btn btn-warning" onclick="editEntre();">Editar datos</a>
    <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar entrenador</a>
  </li>
</ul>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar entrenador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Esta acción no se podrá deshacer, los competidores con este entrenador pasarán a no tener ninguno</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>
