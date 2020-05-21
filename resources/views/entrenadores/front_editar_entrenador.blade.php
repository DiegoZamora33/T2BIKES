
@if(Auth::check())
    @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
        <div class="row">

        <div class="text-left col-md-2">
          <a onclick="getEntreR()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
          <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
            <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
          </a>
        </div>

        <h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Editar Entrenador</h3>


        <input type="hidden" name="idEntrenador" value="{{ $entrenador->idEntrenador }}" id="idEntrenador">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

        </div>


        <br>

        <form class="form-horizontal"  name="formulario" action="" onSubmit="updateEntrenador(); return false">
          
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="nombre">Nombre</label>
              <input id="nombre" name="nombre" type="text" class="form-control" value=" {{ $entrenador->nombre }} " title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" maxlength="50" required>
            </div>
            <div class="form-group col-md-4">
              <label for="apellidoPaterno">Apellido Paterno</label>
              <input id="apellidoPaterno" name="apellidoPaterno" type="text" class="form-control" value=" {{ $entrenador->apellidoPaterno }} " title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" maxlength="50" required>
            </div>
            <div class="form-group col-md-4">
              <label for="apellidoMaterno">Apellido Materno</label>
              <input id="apellidoMaterno" name="apellidoMaterno" type="text" class="form-control" value=" {{ $entrenador->apellidoMaterno }} " title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" maxlength="50">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4 mx-auto">
              <label for="patrocinio">Patrocinadores</label>
              <textarea type="text" class="form-control" id="patrocinio" name="patrocinio" row="5" > {{ $entrenador->patrocinio }} </textarea>
              <small id="emailHelp" class="form-text text-muted"> Escriba todas la empresas u organizaciones separadas por una coma (,) </small>
            </div>
          </div>
          
          <button type="button" onclick="getEntreR()" class="btn btn-danger">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
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
          2500);
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