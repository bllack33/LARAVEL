<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrutasController extends Controller
{
    //accion que devuelva una vista
    public function index(){
    	return view('frutas.index')
    			->with('frutas', array('fresa','mora','manzana','peras','mango','seis','siete','ocho','nueve','diz','once'));
    }

    public function naranjas(){
    	return 'accion de naranjas';
    }
    public function peras(){
    	return 'accion de peras';
    }

}
