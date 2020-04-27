<h2>hola</h2>

Mostrar datos 
<table class="table table-light">

	<thead class="thead-light">

		<tr>
			<th>Nombre</th>
			<th>Email</th>
			<th>Tipo de Usuario</th>
			<th>Fecha de registro </th>

		</tr>
		

	</thead>

	<tbody>
	@foreach($usuarios as $usuario)
		<tr>
			<td>{{$usuario->name}}</td>
			<td>{{$usuario->email}}</td>
			<td>{{$usuario->idtipoUsuario}}</td>
			<td>{{$usuario->created_at}}</td>
			
		</tr>
	@endforeach	
	</tbody>


</table>

