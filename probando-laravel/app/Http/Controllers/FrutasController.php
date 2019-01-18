<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrutasController extends Controller
{
    //accion que devuelva una vista
    public function getIndex(){
    	return view('frutas.index')
    			->with('frutas', array('fresa','mora','manzana','peras','mango','seis','siete','ocho','nueve','diz','once'));
    }

    public function getNaranjas(){
    	return 'accion de naranjas';
    }
    public function anyPeras(){
    	return 'accion de peras';
    }

    public function recibirFormulario(Request $request){
    	$data = $request;

    	//mejor forma sin asignar valores a un array
    	return  'el nombre de la fruta es: '.$request->input('nombre');

    	//return  'el nombre de la fruta es: '.$data['nombre'];
    }

}
