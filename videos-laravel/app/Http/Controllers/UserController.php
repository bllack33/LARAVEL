<?php

namespace App\Http\Controllers;

use App\Video;
use App\UserV;

class UserController extends Controller
{
    public function channel($user_id)
    {
        $user = UserV::find($user_id);

        if (is_null($user)) {
            return redirect()->route('home');
        }

        $videos = Video::where('user_id', $user_id)->paginate(5);

        return view('user.usuario', array(
            'user' => $user,
            'videos' => $videos,
        ));
    }
}
