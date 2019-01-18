<h1>Listado de frutas</h1>
<ul>
	@foreach($frutas as $fruta)
		<li>{{$fruta}}</li>
	@endforeach
</ul>


<a href="{{ action('FrutasController@getNaranjas') }}">ir a naranjas</a>
<br>
<a href="{{ action('FrutasController@anyPeras') }}">ir a peras</a>


<h1>Formulario en Laravel</h1>

<form action="{{ url('/recibir') }}" method="POST">
	<p>
	<label for="nombre"> Nombre de la fruta:</label>
	<input type="text" name="nombre">
	</p>
	<p>
	<label for="descripcion"> Descripcion de la fruta:</label>
	<textarea name="descripcion"></textarea> 
	</p>
	<input type="submit" value="enviar">

</form>