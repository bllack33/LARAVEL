<h1>Listado de frutas</h1>
<ul>
	@foreach($frutas as $fruta)
		<li>{{$fruta}}</li>
	@endforeach
</ul>


<a href="{{ action('FrutasController@naranjas') }}">ir a naranjas</a>
<br>
<a href="{{ action('FrutasController@peras') }}">ir a peras</a>