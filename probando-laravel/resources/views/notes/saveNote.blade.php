@if(!isset($note))
	<h1>Crear una nota</h1>
@else
	<h1>Actualizar la nota</h1>
@endif
<form action="{{ !isset($note) ? url('/saveNote') : url('/updateNote/'.$note->id) }}" method="post">
	<input type="text" name="title" placeholder="Titulo de la nota" value="{{isset($note)?$note->title:''}}">
	<br>
	<textarea name="descripcion" placeholder="Descripcion de la nota" cols="30" rows="10" >{{isset($note)?$note->descripcion:''}}</textarea>
	<br>
	<input type="submit" value="Guardar">
</form>

<a href="{{ url('/notas')}}">Volver al listado</a>