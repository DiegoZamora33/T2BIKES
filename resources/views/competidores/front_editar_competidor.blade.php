<form action="{{ url('/competidores/'.$competidor->numeroCompetidor) }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}	
	{{ method_field('PATCH') }}
	
	<div class="Dato">
		<label for="nombre">Nombre: </label>
		<input type="text" name="nombre" id="nombre" value="{{ $competidor->nombre }}" pattern="^[a-zA-ZñÑáéíóú.\s]{0,50}$" title="El nombre solo pose letras, acentos, puntos y espacios (Maximo 50 caracteres)" required>    
	</div class="Dato"> 
	
	<div class="Dato">
		<label for="apellidoPaterno">Apellido Paterno: </label>
		<input type="text" name="apellidoPaterno" id="apellidoPaterno" value="{{ $competidor->apellidoPaterno }}" pattern="^[a-zA-ZñÑáéíóú]{0,50}$" title="El apellido paterno solo pose letras y acentos (Maximo 50 caracteres)" required>    
	</div class="Dato"> 
	
	<div class="Dato">
		<label for="apellidoMaterno">Apellido Materno: </label>
		<input type="text" name="apellidoMaterno" id="apellidoMaterno" value="{{ $competidor->apellidoMaterno }}" pattern="^[a-zA-ZñÑáéíóú]{0,50}$" title="El apellido materno solo pose letras y acentos (Maximo 50 caracteres)">    
	</div class="Dato"> 
	
	<div class="Dato">
		<label for="fechaRegistro">Fecha de Registro:  </label>
		<input type="date" name="fechaRegistro" id="fechaRegistro" value="{{ $competidor->fechaRegistro }}" required>
	</div>

	<div class="Boton">
		<input type="submit" value="Enviar">
	</div>
</form>