<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//librerias importadas
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

//se importan los modelos de las bases de datos
use App\Video;
use App\Comment;



class VideoController extends Controller
{
    public function createVideo(){
    	return view('video.createVideo');
    }

    public function saveVideo(Request $request){
    	//validar formulario
    	$validatedData = $this->validate($request, [
    		'title' => 'required|min:5',
    		'description' =>'required',
    		'video' => 'mimes:mp4'
    	]);

    	$video = new Video();
    	$user = \Auth::user(); //para obtener el usuario

    	$video->user_id = $user->id;
    	$video->title = $request->input('title');
    	$video->description = $request->input('description');

    	//subida de la miniatura 
    	$image = $request->file('image');
    	if($image){
    		$image_path = time().$image->getClientOriginalName();//nombre del fichero
    		\Storage::disk('images')->put($image_path,\File::get($image));//almacena en la carpeta storage/images la ruta de la imagen
    		$video->image = $image_path;
    	}

    	//subida de el video
    	$Video_file = $request->file('video');
    	if($Video_file){
    		$video_path = time().$Video_file->getClientOriginalName();
    		\Storage::disk('videos')->put($video_path, \File::get($Video_file));
    		$video->video_path = $video_path;
    	}

    	$video->save();//modelo por defecto que guarda en la base de datos

    	return redirect()->route('home')->with(array(
    		'message' => 'El video se a subido correctamente!'
    	));
    }

    public function getImage($filename){
    	$file = Storage::disk('images')->get($filename);
    	return new Response($file,200);
    }
}
