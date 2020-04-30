<h3>Competidores Registrados</h3>
<br>
<table>
  <thead>
    <tr>
      <th scope="col">Número de competidor</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido paterno</th>
      <th scope="col">Apellido materno</th>
      <th scope="col">Fecha de Registro</th>
    </tr>
  </thead>
  <tbody>

  	@foreach($competidores as $competidor)
    <tr id="{{ $competidor->numeroCompetidor }}" onclick="getComp(this);">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_{{ $competidor->numeroCompetidor }}">
      <td data-label="Número de competidor">{{ $competidor->numeroCompetidor }}</td>
      <td data-label="Nombre">{{ $competidor->nombre }}</td>
      <td data-label="Paterno">{{ $competidor->apellidoPaterno }}</td>
      <td data-label="Materno">{{ $competidor->apellidoMaterno }}</td>
      <td data-label="Registro">{{ str_limit($competidor->created_at, $limit = 10, $end = " ") }}</td>
    </tr>
    @endforeach

  </tbody>
</table>

<ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
  <li id="registrar-entrenador" class="p-2">
    <a type="button" onclick="newComp();" class="btn btn-primary">Registrar Nuevo</a>
  </li>
</ul>
