<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{
    //MUESTRA LA NOTA EN ORDEN DESCENDENTE
    public function getIndex(){

    	$notas = DB::table('notes')->orderBy('id','desc')->get();
    	
    	// foreach ($notas as $note) {
    	// 	echo $note->title."<br>";
    	// }

    	return view('notes.index', array(
    		'notes' => $notas
    	));
    }

    //CONSULTAS BASE DE DATOS
    public function getNote($id){  
    	// dd($id);   	
    	//conseguir una nota concreta
    	$note = DB::table('notes')->select('id', 'title','descripcion')->where('id',$id)->first(); //trae solo el id, titulo y descripcion
    	// $note = DB::table('notes')->where('id',$id)->first(); //trae todo lo de la base de datos
    	//var_dump($note);
    	return view('notes.note', array(
    		'note' => $note
    	));
    }

    //INSERT O CREAR EN BASE DE DATOS
    public function postNote(Request $request){
    	$note = DB::table('notes')->insert(array(
    		'title'=> $request->input('title'),
    		'descripcion' => $request ->input('descripcion')
    	));
    	return redirect()->action('NotesController@getIndex');
    }
    //para mostrar la vista saveNote
    public function getSaveNote(){
    	return view('notes.saveNote');
    }
    //ELIMINAR DE LA BASE DE DATOS
    public function getDeleteNote($id){

    	$note = DB::table('notes')->where('id',$id)->delete();

    	return redirect()->action('NotesController@getIndex')->with('status', 'Nota borrada correctamente');
    }

    //ACTUALIZAR EN LA BASE DE DATOS
    public function postUpdateNote($id, Request $request){
    	$note = DB::table('notes')->where('id', $id)->update(array(
    		'title' => $request->input('title'),
    		'descripcion' => $request->input('descripcion')
    	));

    	return redirect()->action('NotesController@getIndex')->with('status', 'Nota Actualizada correctamente');
    }

    public function getUpdateNote($id){

    	$note = DB::table('notes')->where('id',$id)->first();
    	return view('notes.saveNote', array(
    		'note' => $note
    	));
    }

}
