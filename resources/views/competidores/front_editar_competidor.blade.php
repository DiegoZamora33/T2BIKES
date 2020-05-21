@if(Auth::check())

  @if(Auth::user()->idtipoUsuario == 1 || Auth::user()->idtipoUsuario == 2)
		<div class="row">

			<div class="text-left col-md-2">
			  <a id="{{ $competidor->numeroCompetidor }}" onclick="getComp(this)" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">

			  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			  <input type="hidden" name="_numeroCompetidor" value="{{ $competidor->numeroCompetidor }}" id="numeroCompetidor">


			  <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
			    <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
			  </a>
			</div>

		<h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Editar Competidor</h3>
		</div>


		<form class="form-horizontal"  name="formulario" action="" onSubmit="updateCompetidor(); return false">

			<input type="hidden" name="_tokenAsignar" value="{{ csrf_token() }}" id="tokenAsignar"><input type="hidden" value="{{ $competidor->numeroCompetidor }}" id="_numeroCompetidor">

			<br>
				<div class="form-row">
			      <div class="form-group col-md-4 mx-auto">
			        <label for="numeroCompetidor">Numero de Competidor</label>
			        <input type="text" class="form-control text-center" id="numeroCompetidor" name="numeroCompetidor" value="{{ $competidor->numeroCompetidor }}" readonly placeholder="">
			      </div>
			    </div>
				<div class="form-row">
				    <div class="form-group col-md-4">
				      <label for="nombre">Nombre</label>
				      <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $competidor->nombre }}" pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" title="El nombre solo pose letras, acentos, puntos y espacios (Maximo 50 caracteres)" required>
				    </div>
				    <div class="form-group col-md-4">
				      <label for="apellidoPaterno">Apellido Paterno</label>
				      <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" value="{{ $competidor->apellidoPaterno }}" pattern="^[a-zA-ZñÑáéíóú]{0,50}$" title="El apellido paterno solo pose letras y acentos (Maximo 50 caracteres)" required>
				    </div>
				    <div class="form-group col-md-4">
				      <label for="apellidoMaterno">Apellido Materno</label>
				      <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" value="{{ $competidor->apellidoMaterno }}" pattern="^[a-zA-ZñÑáéíóú]{0,50}$" title="El apellido materno solo pose letras y acentos (Maximo 50 caracteres)">
				    </div>
			  </div>

			<br>
			  <button type="button" onclick="getCompR()" class="btn btn-danger">Cancelar</button>
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