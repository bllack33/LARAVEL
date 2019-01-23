<h1>APLICACION DE NOTAS</h1>

<a href="{{ url('/save-Note') }}"> Crear Notas</a>

<h3>Listado de notas:</h3>

@if(session('status'))
	<p style="background:yellow">{{ session('status') }} </p>
@endif
<ul>
	@foreach($notes as $note)
		<li>
			<ul>
				<li>{{$note->title}}</li>
				<li><a href="{{url('/note/'.$note->id)}}">Ver</a></li>
				<li><a href="{{url('/delete-note/'.$note->id)}}">Borrar</a></li>
				<li><a href="{{url('/update-note/'.$note->id)}}">Actualizar</a></li>
			</ul>
		</li>
	@endforeach
</ul>