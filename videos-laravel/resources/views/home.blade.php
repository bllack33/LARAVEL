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
                            <a href="{{route('detailVideo',['video_id' => $video->id])}}" class="btn btn-success">Ver</a>
                            @if(Auth::check() && (Auth::user()->id == $video->user->id || $video->user->role == 'ADMIN'))
                                <a href="" class="btn btn-warning">Editar</a>
                                <a href="Modal{{$video->id}}" type="button" class="btn btn-danger" data-toggle="modal" data-target="#Modal{{$video->id}}">
                                  Eliminar
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="Modal{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">¿Estás seguro?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <p>¿Seguro que quieres borrar el video?</p>
                                        <p class="text-danger"><small>- {{$video->title}}</small></p>
                                      </div>

                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ url('/delete-video/'.$video->id)}} " type="button" class="btn btn-danger rounded">Eliminar</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
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
