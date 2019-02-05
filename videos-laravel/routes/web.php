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

Route::get('/home', 'HomeController@index')->name('home');

//rutas del controlador de videos
Route::get('/crear-video',array(
	'as' => 'createVideo', //nombre de ruta
	'middleware' =>'auth', //este nombre esta por defecto y comprueba si esta logueado o no 'auth'
	'uses' => 'VideoController@createVideo' //usa el controlador video y la accion de crear video.
));
