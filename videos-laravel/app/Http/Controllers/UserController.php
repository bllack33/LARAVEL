<?php

namespace App\Http\Controllers;

use App\Video;
use App\User;

class UserController extends Controller
{
    public function channel($user_id)
    {
        $user = User::find($user_id);
        $videos = Video::where('user_id', $user_id)->paginate(5); //busca todo los videos creador por el usuario que se logueo

        return view('user.usuario', array(
            'user' => $user,
            'videos' => $videos,
        ));
    }
}
