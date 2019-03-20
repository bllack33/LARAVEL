@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <div class="col-md-4">
                <h2>Busqueda: {{$search}}</h2>
            </div>
            <br>
            <div class="col-md-8 float-right">
                <form action="{{ url('/buscar/'.$search) }}" class="col-md-3 float-right" method="get">
                    <label for="filter">Ordenar</label>
                    <select name="filter" id="filter" class="form-control">
                        <option value="new">Mas nuevo primero</option>
                        <option value="old">Mas antiguo primero</option>
                        <option value="alfa">De la A a la Z</option>
                    </select>
                    <input type="submit" value="Ordenar" class="btn-filter btn btn-sm btn-primary">
                </form>
            </div>
            <div class="clearfix"></div>
            @include('video.videosList');
        </div>
    </div>
</div>
@endsection






