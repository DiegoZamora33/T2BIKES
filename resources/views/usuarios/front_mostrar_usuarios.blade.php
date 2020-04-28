<h3>Usuarios Registrados</h3>
<p>Seleccione uno para poder editarlo</p>
<br>
<table>
  <thead>
    <tr>
      <th scope="col">Usuario</th>
      <th scope="col">Nombre</th>
      <th scope="col">Tipo</th>
      <th scope="col">Fecha de Registro</th>
    </tr>
  </thead>
  <tbody>

  	@foreach($usuarios as $usuario)
    <tr id="{{ $usuario->email }}" onclick="getUser(this);">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_{{ $usuario->email }}">
      <td data-label="Nombre">{{ $usuario->name }}</td>
      <td data-label="Email">{{ $usuario->email }}</td>
      <td data-label="Tipo">{{ $usuario->idtipoUsuario }}</td>
      <td data-label="FechaRegistro">{{ $usuario->created_at }}</td>
    </tr>
    @endforeach

  </tbody>
</table>

<ul class="d-flex align-items-end flex-column fixed-bottom" style="color: white;">
  <li id="registrar-usuario" class="p-2">
    <a type="button" onclick="newUser();" class="btn btn-primary">Registrar nuevo</a>
  </li>
</ul>


