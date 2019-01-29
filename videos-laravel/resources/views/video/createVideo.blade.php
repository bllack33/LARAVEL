@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="display: block;">
		<h2>Crear un nuevo video</h2>
		<hr>
		<form action="" method="post" enctype="multipart/form-data" class="col-lg-7">
			<div class="form-group">
				<label for="title">Titulo</label>
				<input type="text" class="form-control" id="title" name="title">
			</div>

			<div class="form-group">
				<label for="description">Descripcion </label><br>
				<textarea name="description" id="description"></textarea>
			</div>

			<div class="form-group">
				<label for="image">Miniatura</label>
				<input type="file" class="form-control" id="image" name="image"/>
			</div>

			<div class="form-group">
				<label for="video">Archivo de video</label>
				<input type="file" class="form-control" id="video" name="video"/>
			</div>
			<button type="submit" class="btn btn-success">Crear video</button>
		</form>
	</div>
</div>
@endsection