<div class="row">

<div class="text-left col-md-2">
  <a onclick="usuarios()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
  <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
    <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
  </a>
</div>

<h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Registrar Usuario</h3>

</div>


<br>

<form class="form-horizontal"  name="formulario" action="" onSubmit="enviarUsuario(); return false">
  <div class="form-row">
    
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

    <div class="form-group col-md-4">
      <label for="name">Nombre Completo</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Ej. Juan Pérez">
    </div>

    <div class="form-group col-md-4">
      <label for="email">Email</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Ej. Juanit01@gmail.com">
    </div>

    <div class="form-group col-md-4">
      <label for="tipoUsuario">Tipo</label>
      <select class="form-control" id="tipoUsuario" name="tipoUsuario">
          <option value="0">Sin Asignar</option>
          <option value="1">Administrador</option>
          <option value="2">Consulta</option>
          <option value="3">Registro</option>
      </select>

    </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-4 mx-auto">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Use numeros y letras">
      </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-4 mx-auto">
        <label for="password-confirm">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Repita la Contraseña">
      </div>
  </div>
<br>


  <button type="submit" class="btn btn-primary">Registrar</button>
</form>