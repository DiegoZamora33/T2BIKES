
@if(Auth::check())
    @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
      <div class="row">

      <div class="text-left col-md-2">
        <a onclick="entrenadores()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
        <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
          <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
        </a>
      </div>

      <h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Registrar Entrenador</h3>

      </div>


      <br>
      <form class="form-horizontal"  name="formulario" action="" onSubmit="enviarEntrenador(); return false">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder=" " title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" maxlength="50" required>
          </div>
          <div class="form-group col-md-4">
            <label for="apellidoPaterno">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" maxlength="50" required>
          </div>
          <div class="form-group col-md-4">
            <label for="apellidoMaterno">Apellido Materno</label>
            <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno"  title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" maxlength="50">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4 mx-auto">
            <label for="patrocinio">Patrocinadores</label>
            <textarea type="text" class="form-control" id="patrocinio" name="patrocinio" row="5"> </textarea>
            <small id="emailHelp" class="form-text text-muted"> Escriba todas la empresas u organizaciones separadas por una coma (,) </small>
          </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>
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

