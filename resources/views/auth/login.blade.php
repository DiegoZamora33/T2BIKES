@extends('layouts.app')

@section('content')
<div class="container text-center d-lg-block d-md-block d-sm-none">
  <div class="row flex-column flex-md-row login shadow fondo p-3 mb-5 rounded">
    <div class="col col-md-6 col-sm-12">
      <img class="img-fluid" src="{{ asset('t2bikes/img/fondo2.png') }}" alt="pr2">
    </div>
    <div class="col col-md-6 col-sm-12">
      <br><br>
      <img class="rotate" src="{{ asset('t2bikes/img/miRueda.png') }}" width="100" alt="rueda">
      <br><br>
      <h4 class="display-5">SISTEMA PARA CONTROL</h4>
      <h4 class="font-weight-bold" style="display-5">DE DATOS Y ESTADÍSTICAS</h4><br>


      <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

        </div>


        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Contraseña</label>

            
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            
        </div>


        <small id="emailHelp" class="form-text text-muted">Si no recuerdas la contraseña, comunicate con algún administrador.</small>
        <br>
        <button type="submit" class="btn btn-primary">INICIAR SESIÓN</button>
      </form>
    </div>
  </div>
</div>







  <div class=" text-center d-lg-none d-md-none d-sm-block bg-white">
    <div class="row flex-column flex-md-row">
      <div class="col col-md-6 col-sm-12">
        <img class="img-fluid"src="{{ asset('t2bikes/img/fondo2.png') }}" alt="pr2">
      </div>
      <div class="col col-md-6 col-sm-12">
        <br>
        <img class="rotate" src="{{ asset('t2bikes/img/miRueda.png') }}" width="100" alt="ruedaPhone">
        <br><br>
        <h4 class="display-5">SISTEMA PARA CONTROL</h4>
        <h4 class="font-weight-bold" style="display-5">DE DATOS Y ESTADÍSTICAS</h4><br>


      <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">Usuario/Correo Electronico</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

        </div>


        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Contraseña</label>

            
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            
        </div>


        <small id="emailHelp" class="form-text text-muted">Si no recuerdas la contraseña, comunicate con algún administrador..</small>
        <br>
        <button type="submit" class="btn btn-primary btn-lg">INICIAR SESIÓN</button>
      </form>


        
      </div>
    </div>
    <br>
  </div>
@endsection
