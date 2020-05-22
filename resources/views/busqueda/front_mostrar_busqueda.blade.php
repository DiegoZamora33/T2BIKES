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
    <tr id="{{ $competidor->numeroCompetidor }}" onclick="getComp(this);" style="cursor: pointer;">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_{{ $competidor->numeroCompetidor }}">
      <td data-label="Número de competidor">{{ $competidor->numeroCompetidor }}</td>
      <td data-label="Nombre">{{ $competidor->nombre }}</td>
      <td data-label="Paterno">{{ $competidor->apellidoPaterno }}</td>
      <td data-label="Materno">{{ $competidor->apellidoMaterno }}</td>
      <td data-label="Registro">{{ substr(str_limit($competidor->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($competidor->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($competidor->created_at, $limit = 10, $end = " "),0,4)}}</td>
    </tr>
    @endforeach

  </tbody>
</table>

<h3>Entrenadores Registrados</h3>
<br>
<table>
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido paterno</th>
      <th scope="col">Apellido materno</th>
      <th scope="col">Patrocinadores</th>
      <th scope="col">Fecha de Registro</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($entrenadores as $entrenador)
        <tr onclick="getEntre(this);" id="{{ $entrenador->idEntrenador }}" style="cursor: pointer;">
          <td data-label="Nombre">{{$entrenador->nombre}}</td>
          <td data-label="Paterno">{{$entrenador->apellidoPaterno}}</td>
          <td data-label="Materno">{{$entrenador->apellidoMaterno}}</td>
          <td data-label="Patrocinadores">{{$entrenador->patrocinio}}</td>
          <td data-label="Fecha de Registro">{{ substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),0,4)}}</td>
        </tr>
    @endforeach

  </tbody>
</table>

<h3>Competencias Registradas</h2> </h3>
<br>
    
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

    @foreach($competencias as $miCompetencia)
      <div class="card text-center mt-2 " style="color:white;">
        <div class="card-header bg-dark">
          {{ $miCompetencia->nombreCompetencia }}
        </div>
        <div class="card-body"  style="color:black;">

          <?php
           $query= DB::select("SELECT COUNT(*) inscritos FROM competencias
                   INNER JOIN puntaje__competidor__competencias
                    ON competencias.idCompetencia = puntaje__competidor__competencias.idCompetencia
                    WHERE puntaje__competidor__competencias.idCompetencia = ".$miCompetencia->idCompetencia."");      
          ?>
         @foreach($query as $miQuery)
          <h5 class="card-title"> Participantes: {{ $miQuery->inscritos }} </h5>
         @endforeach
          <h6 class="card-text text-muted">Periodo: {{ $miCompetencia->periodo }}</h6>
          <a id="{{ $miCompetencia->idCompetencia }}" onclick="getTour(this);" class="btn btn-primary text-white">Ver más</a>
        </div>
      </div>
      <br>
    @endforeach