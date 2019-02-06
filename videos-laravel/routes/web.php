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
use App\Video;

Route::get('/', function () {

	// $videos = Video::all();

	// foreach ($videos as $video) {
	// 	echo '<br>';
	// 	echo $video->title.'<br>';
	// 	echo $video->user->email.'<br><br>';
	// 	foreach ($video->comments as $comment) {
	// 		echo $comment->body;
	// 	}
	// 	echo '<br>';

	// }

    return view('welcome');
});

Auth::routes();

Route::get('/home', array(
	'as' => 'home', //nombre de ruta
	'uses' => 'HomeController@index' //usa el controlador video y la accion de crear video.
));

//rutas del controlador de videos
Route::get('/crear-video',array(
	'as' => 'createVideo', //nombre de ruta
	'middleware' =>'auth', //este nombre esta por defecto y comprueba si esta logueado o no 'auth'
	'uses' => 'VideoController@createVideo' //usa el controlador video y la accion de crear video.
));

Route::post('/guardar-video',array(
	'as' => 'saveVideo', //nombre de ruta, en el action del formulario se usa con {{route('saveVideo')}} si no es con url{{'/guardar-video'}}
	'middleware' =>'auth', //este nombre esta por defecto y comprueba si esta logueado o no 'auth'
	'uses' => 'VideoController@saveVideo' //usa el controlador video y la accion de crear video.
));

