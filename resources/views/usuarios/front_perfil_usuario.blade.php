<div class="row">

<div class="text-left col-md-2">
  <a onclick="usuarios()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
  <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
    <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
  </a>
</div>

<h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Perfil del Usuario</h3>

</div>

@foreach($usuario as $miUsuario)
<h5>Nombre: {{ $miUsuario->name }}</h5>


<br>

<form>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Nombre</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $miUsuario->name }}" placeholder="">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Email</label>
      <input type="text" class="form-control" id="email" name="email" value="{{ $miUsuario->email }}" placeholder="">
    </div>
    <div class="form-group col-md-4">
      <label for="inputAddress">Tipo</label>
      <select class="form-control">
          <option value="{{ $miUsuario->id }}">{{ $miUsuario->idtipoUsuario }}</option>

          @if( $miUsuario->id  == 1)
            <option value="2">Registro</option>
            <option value="3">Consulta</option>
            @elseif ( $miUsuario->id == 2)
               <option value="1">Administrador</option>
               <option value="3">Consulta</option>
               @elseif ( $miUsuario->id  == 3)       
                  <option value="1">Administrador</option>
                  <option value="2">Registro</option>
          @endif
      </select>
    </div>
  </div>
  <div class="form-row">
      <div class="form-group col-md-4 mx-auto">
        <label for="inputCity">Contraseña</label>
        <input type="text" class="form-control" id="inputCity" value="123456" placeholder="">
      </div>
  </div>

<br>

  <button type="submit" class="btn btn-danger">Cancelar</button>
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<ul class="d-flex align-items-end flex-column fixed-bottom text-white">
  <li id="registrar-entrenador" class="p-2">
    <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar usuario</a>
  </li>
</ul>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Esta acción no se podrá deshacer, el usuario ya no tendrá acceso al sistema.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>
@endforeach