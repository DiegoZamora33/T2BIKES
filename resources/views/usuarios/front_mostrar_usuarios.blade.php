 
@if(Auth::check())
   @if(Auth::user()->idtipoUsuario == 1)
    <h3>Usuarios Registrados</h3>
    <p>Seleccione uno para poder editarlo</p>
    <br>
    <table>
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Correo</th>
          <th scope="col">Tipo</th>
          <th scope="col">Fecha de Registro</th>
        </tr>
      </thead>
      <tbody>

      	@foreach($usuarios as $usuario)
        <tr id="{{ $usuario->email }}" onclick="getUser(this);" style="cursor: pointer;">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_{{ $usuario->email }}">
          <td data-label="Nombre">{{ $usuario->name }}</td>
          <td data-label="Email">{{ $usuario->email }}</td>
          <td data-label="Tipo">{{ $usuario->idtipoUsuario }}</td>
          <td data-label="Registro">{{substr(str_limit($usuario->created_at, $limit = 10, $end = " "),8,2)."/".substr(str_limit($usuario->created_at, $limit = 10, $end = " "),5,2)."/".substr(str_limit($usuario->created_at, $limit = 10, $end = " "),0,4)}}</td>
        </tr>
        @endforeach

      </tbody>
    </table>

    <ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
      <li id="registrar-usuario" class="p-2">
        <a type="button" onclick="newUser();" class="btn btn-primary">Registrar Nuevo</a>
      </li>
    </ul>
  @else
    <h4>No tienes permisos para realizar esto... </h4>
    <h5>Serás Redirigido a la Pagina Principal</h5>
    <script type="text/javascript">
      setTimeout(
        function()
        { 
          window.location = "{{ url('/home') }}";
        }, 
        2000);
    </script>
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

