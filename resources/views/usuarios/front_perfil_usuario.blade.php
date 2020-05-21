 
@if(Auth::check())
   @if(Auth::user()->idtipoUsuario == 1)
      <div class="row">

        <div class="text-left col-md-2">
          <a onclick="usuarios()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
          <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
            <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
          </a>
        </div>

        <h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Perfil del Usuario</h3>

      </div>

      <h5>Nombre: {{ $usuario->name }}</h5>
      <input type="hidden" id="idUsuario" value="{{$usuario->id}}">

      <br>
      <form action="" method="post" onsubmit="return editarUsuario()">
        <input type="hidden" value="{{ csrf_token() }}" id="token">
        
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="name">Nombre Completo</label>
            <input title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" type="text" class="form-control" id="name" name="name" value="{{ $usuario->name }}" required>
          </div>

          <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input title="Por favor introduzca una cuenta de correo valida" type="email" class="form-control" id="email" name="email" value="{{$usuario->email}}" required>
          </div>

          <div class="form-group col-md-4">
            <label for="tipoUsuario">Tipo</label>
            <select class="form-control" id="tipoUsuario" name="tipoUsuario" required>
              @foreach ($tiposUsuario as $tipo)
                <option value="{{$tipo->idTipoUsuario}}" @if ($tipo->idTipoUsuario == $usuario->idtipoUsuario) selected @endif>{{ $tipo->tipo }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4 mx-auto">
            <label for="password">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Use numeros y letras">
          </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4 mx-auto">
              <label for="password-confirm">Confirmar Nueva Contraseña</label>
              <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Repita la Contraseña">
            </div>
        </div>

        <br>
        <input type="button" onclick="usuarios()" class="btn btn-danger" value="Cancelar">
        <input type="submit" class="btn btn-primary" value="Editar">
      </form>

      <ul class="d-flex align-items-end flex-column fixed-bottom text-white">
        <li id="registrar-entrenador" class="p-2">
          <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUser">Eliminar usuario</a>
        </li>
      </ul>

      <div class="modal fade" id="modalDeleteUser" tabindex="-1" role="dialog" aria-labelledby="modalDeleteUser" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalDeleteUser">Eliminar usuario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Esta acción no se podrá deshacer, el usuario ya no tendrá acceso al sistema.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" onclick="eliminarUsuario()">Eliminar</button>
            </div>
          </div>
        </div>
      </div>
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