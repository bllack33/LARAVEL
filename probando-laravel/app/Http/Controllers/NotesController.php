<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{
    //
    public function getIndex(){

    	$notas = DB::table('notes')->get();
    	
    	// foreach ($notas as $note) {
    	// 	echo $note->title."<br>";
    	// }

    	return view('notes.index', array(
    		'notes' => $notas
    	));
    }

    public function getNote($id){  
    	// dd($id);   	
    	//conseguir una nota concreta
    	$note = DB::table('notes')->where('id',$id)->first();
    	// dd()
    	return view('notes.note', array(
    		'note' => $note
    	));
    }

}
