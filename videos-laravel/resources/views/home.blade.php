@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                
            @endif
            <div id="videos-list">
                @foreach($videos as $video)
                    <div class="video-item col-md-10 float-md-left panel panel-default">
                        <div class="panel-body">     
                            {{-- imagen del video --}}
                            @if(Storage::disk('images')->has($video->image))
                                <div class="video-image-thumb col-md-4 float-md-left">
                                    <div class="video-image-mask">
                                        <img src="{{ url('/miniatura/'.$video->image) }}" alt="{{$video->image}}" class="video-image">
                                    </div>                                
                                </div>                            
                            @endif
                            <div class="data">
                               <a href="{{route('detailVideo',['video_id' => $video->id])}}"> <h4>{{$video->title}}</h4> </a>
                               <p>{{$video->user->name.' '. $video->user->surname}}</p>
                            </div>
                            {{-- BOTONES DE ACCION--}}
                            <a href="" class="btn btn-success">Ver</a>
                            @if(Auth::check() && Auth::user()->id == $video->user->id)
                                <a href="" class="btn btn-warning">Editar</a>
                                <a href="" class="btn btn-danger">Eliminar</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{$videos->links()}}
    </div>
</div>
@endsection
