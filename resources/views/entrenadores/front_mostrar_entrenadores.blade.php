@if(Auth::check())
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
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_{{ $entrenador->numeroCompetidor }}">
              <td data-label="Nombre">{{$entrenador->nombre}}</td>
              <td data-label="Paterno">{{$entrenador->apellidoPaterno}}</td>
              <td data-label="Materno">{{$entrenador->apellidoMaterno}}</td>
              <td data-label="Patrocinadores">{{$entrenador->patrocinio}}</td>
              <td data-label="Fecha de Registro">{{ substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($entrenador->created_at, $limit = 10, $end = " "),0,4)}}</td>
            </tr>
        @endforeach

      </tbody>
    </table>

    @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
      <ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
        <li id="" class="p-2">
          <a type="button" onclick="newTrain();" class="btn btn-primary">Registrar nuevo</a>
        </li>
      </ul>
    @endif
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