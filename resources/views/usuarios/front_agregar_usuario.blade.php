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
<!--form>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Nombre Completo</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Ej. Juan Pérez">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Nombre de Usuario</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="Ej. Juanit01">
    </div>
    <div class="form-group col-md-4">
      <label for="inputAddress">Tipo</label>
      <select class="form-control">
          <option>Sin Asignar</option>
          <option>Administrador</option>
          <option>Básico</option>
      </select>
    </div>
  </div>
  <div class="form-row">
      <div class="form-group col-md-4 mx-auto">
        <label for="inputCity">Contraseña</label>
        <input type="password" class="form-control" id="inputCity" placeholder="Use numeros y letras">
      </div>
  </div>
<br>


  <button type="submit" class="btn btn-primary">Registrar</button>
</form-->

                    <form class="form-horizontal" method="POST" action="home/usuarios">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Tipo de Usuario</label>

                            <div class="col-md-6">
                                <input id="idtipoUsuario" type="text" class="form-control" name="idtipoUsuario" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>