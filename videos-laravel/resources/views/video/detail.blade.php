@extends('layouts.app')

@section('content')

<div class="col-md-10 offset-md-2">
	<h2>{{$video->title}}</h2>
	<hr>
	<div class="col-md-8">
		{{-- video --}}
		<video controls id="video-player">
			<source  src="{{ route('filevideo',['filename' => $video->video_path])}}" type="video/mp4">
			Tu navegardor no es compatible con HTML5
		</video>
		{{-- decripcion --}}
		<div class="panel panel-default video-data">
			<div class="panel-heading">
				<div class="panel-title">
					Subido por <strong><a href="{{route('usuario',['user_id'=> $video->user_id])}}">{{$video->user->name.' '. $video->user->surname}}</a> {{$video->user->name.' '.$video->user->surname}}</strong> {{ \FormatTime::LongTimeFilter($video->created_at)}}
				</div>
			</div>
			<div class="panel-dody">
				{{$video->description}}
			</div>
		</div>
		<div>
			<a href="{{ route('home')}}" > <h4>Regresar</h4></a>
		</div>
		{{-- comentarios --}}

		@include('video.comments')

	</div>
</div>

@endsection
