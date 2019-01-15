@include('contacto.cabecera')

<h1> pagina de contacto </h1>

{{--http://www.cursol2laravel.net/contacto/juan/78--}}

<p>el nombre: <strong>{{$nombre}}</strong> viene en un arreglo y por get</p> 
<p>se mandan los datos por array</p>
<br>
<p>if ternario</p>
<h1>Página de contacto {!!$nombre!!} {{isset($edad) && !is_null($edad) ? $edad : "no existe la edad"}} </h1>
<br>

<h1>if normal</h1>
@if(is_null($edad))
	No existe la edad
@else
	si existe la edad: {{$edad}} (46 por defecto si no se manda por url la edad)
@endif
