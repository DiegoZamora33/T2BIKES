
@if(Auth::check())
    @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
    <div class="row">

    <div class="text-left col-md-2">
      <a onclick="competidores()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
      <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
        <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
      </a>
    </div>

    <h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Registrar Competidor</h3>

    </div>


    <br>


    <form class="form-horizontal"  name="formulario" action="" onSubmit="enviarCompetidor(); return false">

     <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="nombre">Nombre</label>
          <input title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" type="text" class="form-control" id="nombre" name="nombre" placeholder="" required autofocus>
        </div>
        <div class="form-group col-md-4">
          <label for="apellidoPaterno">Apellido Paterno</label>
          <input title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" placeholder="" required>
        </div>
        <div class="form-group col-md-4">
          <label  for="apellidoMaterno">Apellido Materno</label>
          <input title="No se admiten caracteres especiales como '(){}?¿' etc..." pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" placeholder="">
        </div>
      </div>
      <div class="form-row">
          <div class="form-group col-md-4 mx-auto">
            <label for="numeroCompetidor">Numero de Competidor</label>
            <input title="Solo se admiten numeros en un rango de 10 digitos" pattern="[0-9]{1,10}" type="number" class="form-control" id="numeroCompetidor" name="numeroCompetidor" placeholder="" required>
          </div>

        <div class="form-group col-md-4">
          <label for="competencia">Competencia</label>
          <select id="competencia" name="competencia" class="form-control">
              <option value="0">Sin Asignar</option>

              @foreach($competencias as $miCompetencia)
                 <option value="{{ $miCompetencia->idCompetencia }}">{{ $miCompetencia->nombreCompetencia }}</option>
              @endforeach

          </select>
        </div>

        <div class="form-group col-md-4">
          <label for="entrenador">Entrenador</label>
          <select id="entrenador" name="entrenador" class="form-control">
              <option value="0">Sin Asignar</option>

              @foreach($entrenadores as $miEntrenador)
                <option value="{{ $miEntrenador->idEntrenador }}">{{ $miEntrenador->nombre }} {{ $miEntrenador->apellidoPaterno }} {{ $miEntrenador->apellidoMaterno }}</option>
              @endforeach

          </select>
        </div>


      </div>

      <div class="container d-flex justify-content-center">
        <div class="col-md-4">
          <label for="tiempoEntrenamiento">Tiempo de Entrenamiento</label>
          <div class="d-flex w-50 mx-auto">
            <input type="number" class="form-control" id="tiempoEntrenamiento" name="tiempoEntrenamiento" min="0" max="18" value="0">
            <label class="mt-auto ml-3">Meses</label>
          </div>
        </div>
      </div>
    <br>


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