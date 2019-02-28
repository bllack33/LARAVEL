@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="display: block;">
		<h2>Editar {{$video->title}}</h2>
		<hr>
		<form action="{{route('updateVideo',['video_id' => $video->id])}}" method="post" enctype="multipart/form-data" class="col-lg-7">
			{!! csrf_field() !!}

			@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{$errors}}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="form-group">
				<label for="title">Titulo</label>
				<input type="text" class="form-control" id="title" name="title" value="{{$video->title}}">
			</div>

			<div class="form-group">
				<label for="description">Descripcion </label><br>
				<textarea name="description" id="description">{{$video->description}}</textarea>
			</div>

			<div class="form-group">
				<label for="image">Miniatura</label>
				@if(Storage::disk('images')->has($video->image))                   
                    <div>
                        <img src="{{ url('/miniatura/'.$video->image) }}" alt="{{$video->image}}" class="video-image" style="width: 30%;">
                    </div>           
                @endif
				<input type="file" class="form-control" id="image" name="image"/>
			</div>

			<div class="form-group">				
				<label for="video">Archivo de video</label>	
				<div>
					<video controls id="video-player" style="width: 38%;">
						<source  src="{{ route('filevideo',['filename' => $video->video_path])}}" type="video/mp4">
						Tu navegardor no es compatible con HTML5							
					</video>
				</div>
				<input type="file" class="form-control" id="video" name="video"/>				
			</div>
			<button type="submit" class="btn btn-success">Modificar video</button>
		</form>
	</div>
</div>
@endsection