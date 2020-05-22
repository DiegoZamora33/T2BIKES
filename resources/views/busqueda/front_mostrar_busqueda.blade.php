

@foreach($competidores as $competidor)
  <div class="card mx-auto w-75 mb-4">
      <div class="card btn btn-light p-0 text-left" id="{{ $competidor->numeroCompetidor }}" onclick="getComp(this);">
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_{{ $competidor->numeroCompetidor }}">
         <h6 class="card-header text-white bg-primary mb-0 font-weight-bold">Competidor</h6>
         <div class="card-text mt-1 pl-2 pr-2 d-flex"><h6 class="font-weight-bold mr-2">{{ $competidor->nombre }} {{ $competidor->apellidoPaterno }} {{ $competidor->apellidoMaterno }}</h6><h6>({{ $competidor->numeroCompetidor }})</h6></div>
         <div class="card-text pl-2 pr-2 d-flex"><h6 class="mr-2">Fecha de Registro:</h6><h6>{{ substr(str_limit($competidor->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($competidor->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($competidor->created_at, $limit = 10, $end = " "),0,4)}}</h6></div>
      </div>
  </div>
 @endforeach

@foreach($entrenadores as $entrenador)
  <div class="card mx-auto w-75 mb-4">
      <div class="card btn btn-light p-0 text-left" id="{{ $entrenador->idEntrenador }}" onclick="getEntre(this);">
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_{{ $entrenador->idEntrenador }}">
         <h6 class="card-header text-white bg-info mb-0 font-weight-bold">Entrenador</h6>
         <div class="card-text mt-1 pl-2 pr-2 d-flex"><h6 class="font-weight-bold mr-2">{{ $entrenador->nombre }} {{ $entrenador->apellidoPaterno }} {{ $entrenador->apellidoMaterno }}</h6></div>
         <div class="card-text pl-2 pr-2 d-flex"><h6 class="mr-2">Fecha de Registro:</h6><h6>{{ substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),0,4)}}</h6></div>
      </div>
  </div>
 @endforeach


@foreach($competencias as $competencia)
  <div class="card mx-auto w-75 mb-4">
      <div class="card btn btn-light p-0 text-left" id="{{ $competencia->idCompetencia }}" onclick="getTour(this);">
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_{{ $competencia->idCompetencia }}">
         <h6 class="card-header text-white bg-dark mb-0 font-weight-bold">Competencia</h6>
         <div class="card-text mt-1 pl-2 pr-2 d-flex"><h6 class="font-weight-bold mr-2">{{ $competencia->nombreCompetencia }}</h6></div>
         <div class="card-text pl-2 pr-2 d-flex"><h6 class="mr-2">Fecha de Registro:</h6><h6>{{ substr(str_limit($competencia->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($competencia->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($competencia->created_at, $limit = 10, $end = " "),0,4)}}</h6></div>
      </div>
  </div>
 @endforeach