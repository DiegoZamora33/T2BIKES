<form action="{{ url('/competidores/'.$competidor->numeroCompetidor) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}	
{{ method_field('PATCH') }}

	<label for="Nombre">{{'Nombre'}} </label>

	<input type="text" name="Nombre" id="Nombre" value="{{ $competidor->nombre }}">

	<br/>

	<label for="apellidoPaterno">{{'Apellido Paterno'}} </label>

	<input type="text" name="apellidoPaterno" id="apellidoPaterno" value="{{ $competidor->apellidoPaterno }}">

	<br/>

	<label for="apellidoMaterno">{{'Apellido Materno'}} </label>

	<input type="text" name="apellidoMaterno" id="apellidoMaterno" value="{{ $competidor->apellidoMaterno }}">

	<br/>

	<label for="fechaRegistro">{{'Fecha de registro'}} </label>

	<input type="text" name="fechaRegistro" id="fechaRegistro" value="{{ $competidor->fechaRegistro }}">

	<br/>

	<input type="submit" value="Editar">





</form>