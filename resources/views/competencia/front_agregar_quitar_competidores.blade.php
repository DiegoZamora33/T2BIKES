@if(Auth::check())
  @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
  	<div class="row">
      <div class="text-left col-md-2">
        <a onclick="getTourR()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
        <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
          <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
        </a>
      </div>

      <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
      <input type="hidden" name="_idCompetencia" id="idCompetencia" value="{{$competencia->idCompetencia}}">
      <h3 id="nombreCompetencia" class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">{{$competencia->nombreCompetencia}}</h3>
    </div>
    <h4>Agregar Competidores</h4>

    <p>Para Agregar competidores a la Competencia {{$competencia->nombreCompetencia}} solo escriba el numero de competidor, especifique el entrenador y el tiempo de entrenamiento.</p>
	<form class="form-horizontal mt-5"  name="formulario" action="" onSubmit="meterCompetidor(); return false">

		      <div class="form-row">
		          <div class="form-group col-md-4 mx-auto">
		            <label for="numeroCompetidor">Numero de Competidor</label>
		            <input title="Solo se admiten numeros en un rango de 10 digitos" pattern="[0-9]{1,10}" type="number" class="form-control" id="numeroCompetidor" name="numeroCompetidor" placeholder="Obligatorio" required>
		          </div>

		        <div class="form-group col-md-4">
		          <label for="asignarCompetencia">Competencia</label>
		          <select id="asignarCompetencia" name="asignarCompetencia" class="form-control">
		                 <option value="{{ $competencia->idCompetencia }}">{{ $competencia->nombreCompetencia }}</option>
		          </select>
		        </div>

		        <div class="form-group col-md-4">
		          <label for="asignarEntrenador">Entrenador (opcional)</label>
		          <select id="asignarEntrenador" name="asignarEntrenador" class="form-control">
		              <option value="0">Sin Asignar</option>

		              @foreach($entrenadores as $miEntrenador)
		                <option value="{{ $miEntrenador->idEntrenador }}">{{ $miEntrenador->nombre }} {{ $miEntrenador->apellidoPaterno }} {{ $miEntrenador->apellidoMaterno }}</option>
		              @endforeach

		          </select>
		        </div>


		      </div>

		      <div class="container d-flex justify-content-center">
		        <div class="col-md-4">
		          <label for="mesesEntrenamiento">Tiempo de Entrenamiento (opcional)</label>
		          <div class="d-flex w-50 mx-auto">
		            <input type="number" class="form-control" id="mesesEntrenamiento" name="mesesEntrenamiento" min="0" max="18" value="0">
		            <label class="mt-auto ml-3">Meses</label>
		          </div>
		        </div>
		      </div>
		    <br>


		      <button type="submit" class="btn btn-primary">Registrar</button>
    </form>

    <h4 class="mt-5">Quitar Competidores</h4>

    <p>Para Quitar competidores a la Competencia {{$competencia->nombreCompetencia}} solo escriba el Numero de Competidor</p>
 
      <div class="form-row">
          <div class="form-group col-md-4 mx-auto">
            <label for="numeroCompetidorDel">Numero de Competidor</label>
            <input title="Solo se admiten numeros en un rango de 10 digitos" pattern="[0-9]{1,10}" type="number" class="form-control" id="numeroCompetidorDel" name="numeroCompetidorDel" placeholder="Obligatorio" required>


    	 	 <button type="submit" style="color:white;" class="btn btn-danger mt-2" data-toggle="modal" data-target="#modalQuitarCompetidor" onclick="quienQuitar()" >Quitar</button>
          </div>
      </div>

      <div class="modal fade" id="modalQuitarCompetidor" tabindex="-1" role="dialog" aria-labelledby="modalQuitarCompetidor" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalQuitarCompetidor">Eliminar competidor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-info mb-0 mt-4" id="miAlert">
                Primero Escriba un Numero de Competidor
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-danger" onclick="quitarCompetidor()">Eliminar</button>
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