Mostrar datos 
<table class="table table-light">

	<thead class="thead-light">

		<tr>
			<th>#</th>
			<th>Numero Competidor</th>
			<th>Nombre </th>
			<th>Apellido Paterno </th>
			<th>Apellido Materno </th>
			<th>Fecha de registro </th>

		</tr>
		

	</thead>

	<tbody>
	@foreach($competidores as $competidor)
		<tr>
			<td>{{$loop->iteration}}</td>
			<td>{{$competidor->numeroCompetidor}}</td>
			<td>{{$competidor->nombre}}</td>
			<td>{{$competidor->apellidoPaterno}}</td>
			<td>{{$competidor->apellidoMaterno}}</td>
			<td>{{$competidor->fechaRegistro}}</td>
			<td>

				<a href="{{'/competidores/'.$competidor->numeroCompetidor.'/edit'}}"> Editar</a>


			 | 
			 	<form method="post" action="{{ url('/competidores/'.$competidor->numeroCompetidor) }}">

				{{csrf_field() }}
				{{ method_field('DELETE')}}

				<button type="submit" onclick="return confirm('¿Borrar?');"> Borrar
					
				</button>
				
				</form>
		

			 </td>
		</tr>
	@endforeach	
	</tbody>

</table>