@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">

        <h2>Canal de:{{$videos->user_id}}</h2>

            <div class="clearfix"></div>
            @include('video.videosList')
        </div>
    </div>
</div>
@endsection
