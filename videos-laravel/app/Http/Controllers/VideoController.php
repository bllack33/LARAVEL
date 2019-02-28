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

    public function getVideoDetail($video_id){
        $video = Video::find($video_id); //se usa la entidad con el funcion find que trae el video
        return view('video.detail', array(
            'video' =>$video
        ));
    }

    public function getVideo($filename){
        $file = Storage::disk('videos')->get($filename);
        return new Response($file,200);
    }

    public function getDelete($video_id){
        $user = \Auth::user(); //trae el usuario logueado
        $video = Video::find($video_id); //trae el id del video
        $comments = Comment::where('video_id', $video_id)->get();
        //dd($user,$video);
        if($user && $video->user_id == $user->id){

            //eliminar comentarios
            if($comments  && count($comments) >= 0){  
                foreach ($comments as $comment) {
                    $comment->delete();
                }                              
            }            
            
            //eliminar archivos locales
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);
            
            //eliminamos registro
            $video->delete();

            $message = array('message' => 'Video eliminado correctamente');
        }else{
            $message = array('message' => 'Video no se pudo eliminar!!');
        }
        return redirect()->route('home')->with($message);
    }
    public function edit($video_id){
        $user = \Auth::user(); //trae el usuario logueado
        $video = Video::findOrFail($video_id);
        
        if($user && $video->user_id == $user->id){
            
            return view('video.edit', array(
                'video' => $video
            ));
        }else{
            return redirect()->route('home');
        }
    }

    public function update($video_id, Request $request){
        $validatedData = $this->validate($request, [
            'title' => 'required|min:5',
            'description' =>'required',
            'video' => 'mimes:mp4'
        ]);
        $user = \Auth::user();
        $video = Video::findOrFail($video_id);
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');

        //subida de la miniatura 
        $image = $request->file('image');
        if($image){

            //borrar imagen anterior
            if($video->image){
                Storage::disk('images')->delete($video->image);
            }

            //subida imagen anteponiendo la fecha
            $image_path = time().$image->getClientOriginalName();//nombre del fichero
            \Storage::disk('images')->put($image_path,\File::get($image));//almacena en la carpeta storage/images la ruta de la imagen
                       
            $video->image = $image_path;
        }

        //subida de el video
        $Video_file = $request->file('video');
        if($Video_file){

            //borrar el video viejo
            if($video->video_path){
                Storage::disk('videos')->delete($video->video_path);
            }
            //subir video anteponiendo la fecha
            $video_path = time().$Video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($Video_file));

            $video->video_path = $video_path;
        }

        $video->update();

        return redirect()->route('home')->with(array('message' => 'El video se ha actualizado correctamente!!'));

    }

}
