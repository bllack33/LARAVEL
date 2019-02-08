@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                
            @endif
            <ul id="videos-list">
                @foreach($videos as $video)
                    <li class="video-item col-md-4 float-md-left">
                        {{-- imagen del video --}}
                        @if(Storage::disk('images')->has($video->image))
                            <img src="{{ url('/miniatura/'.$video->image) }}" alt="{{$video->image}}">
                        @endif
                        <div class="data">
                            <h4>{{$video->title}}</h4>
                        </div>
                        {{-- BOTONES DE ACCION--}}

                    </li>
                @endforeach
            </ul>
        </div>
        {{$videos->links()}}
    </div>
</div>
@endsection
