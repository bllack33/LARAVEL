<?php

namespace App\Http\Controllers;

//librerias importadas
//se importan los modelos de las bases de datos
use App\Video;
use App\User;

class UserController extends Controller
{
    public function channel($user_id)
    {
        $user = User::find($user_id);
        $videos = Video::where('user_id', $user_id)->paginate(5); //busca todo los videos creador por el usuario que se logueo

        return view('user.', array(
            'user' => $user,
            'videos' => $videos,
        ));
    }
}
