<hr>
<h4>Comentarios</h4>
<hr>
@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    
@endif
@if(Auth::check())
	<form action="{{url('/comment')}}" class="col-md-4" method="post">
		{!! csrf_field() !!}

		<input type="hidden" class="" name="video_id" value="{{$video->id}}" required>
		<p>
			<textarea class="form-control" name="body" id=""></textarea>
		</p>
		<input type="submit" value="Comentar" class="btn btn-success">
	</form>
<div class="clearfix"></div>
<hr>
@endif

@if(isset($video->comments))
	<div id="comments-list">
		@foreach($video->comments as $comment)
			<div class="comment-item col-md-12 pull-left">
				<div class="panel panel-default video-data">
					<div class="panel-heading">
						<div class="panel-title">
							Subido por <strong>{{$comment->user->name.' '.$comment->user->surname}}</strong> {{ \FormatTime::LongTimeFilter($comment->created_at)}}
						</div>
					</div>					
					<div class="panel-dody">
						<em>{{$comment->body}}</em>

						@if(Auth::user() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $video->user_id || $video->user->role == 'ADMIN'))
							<div class="float-right">
								<a href="Modal{{$comment->id}}" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Modal{{$comment->id}}">
								  Eliminar
								</a>

								<!-- Modal -->
								<div class="modal fade" id="Modal{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLongTitle">¿Estás seguro?</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <p>¿Seguro que quieres borrar el comentario?</p>
								        <p class="text-danger"><small>- {{$comment->body}}</small></p>
								      </div>

								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								        <a href="{{ url('/delete-comment/'.$comment->id)}} " type="button" class="btn btn-danger rounded">Eliminar</a>
								      </div>
								    </div>
								  </div>
								</div>
							</div>
						@endif
					</div>
					<hr>
				</div>			

			</div>
		@endforeach
		
	</div>
@endif

