Mostrar datos 
<table class="table table-light">

	<thead class="thead-light">

		<tr>
			<th>#</th>
			<th>Nombre Competencia</th>
			<th>Periodo </th>
			<th>Estado </th>
			

		</tr>
		

	</thead>

	<tbody>
	@foreach($competencias as $competencia)
		<tr>
			<td>{{$loop->iteration}}</td>
			<td>{{$competencia->nombreCompetencia}}</td>
			<td>{{$competencia->periodo}}</td>
			<td>{{$competencia->estatus}}</td>
			<td>

				<a href="{{'/home/competencias/'.$competencia->idCompetencia.'/edit'}}"> Editar</a>

			 	<form method="post" action="{{ url('/home/competencias/'.$competencia->idCompetencia) }}">

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
	<a href="/home/competencias/create">Crear competencia</a>