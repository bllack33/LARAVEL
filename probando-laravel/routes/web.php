<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/holamundo',function(){
	return "hola nuevo proyecto";
});

Route::match(['get','post'],'/metodos', function(){
	return '<h3>get y post</h3>';
});

Route::any('/cualquiera', function(){
	return '<h3>CUALQUIER METODO CON ANY</h3>';
});

// el signo de interrogacion se usa para decir que el parametro se puede o no enviar
// la sentencia WHERE se usa para validad el tipo de dato con expresiones regulares
// se pasan los datos con un array
Route::get('/contacto/{nombre?}/{edad?}', function($nombre = "nombre por defecto, si no se manda por url", $edad = '46' ){
	return view('contacto.contacto', array(
		"nombre" => $nombre,
		"edad" => $edad
	));
})->where([
	'nombre'=> '[A-Za-z]+', //solo letras
	'edad'=> '[0-9]+' //solo numeros
]);

//se pasan los datos con el metodo WITH
Route::get('/prueba/{nombre?}/{edad?}', function($nombre = "nombre por defecto, si no se manda por url", $edad = '46' ){
	return view('prueba')
			->with('nombre', $nombre)
			->with('edad',$edad);
})->where([
	'nombre'=> '[A-Za-z]+', //solo letras
	'edad'=> '[0-9]+' //solo numeros
]);
