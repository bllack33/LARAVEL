<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

//use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function register(Request $request)
    {
        //recoger post
        $json = $request->input('json', null);
        $params = json_decode($json);

        $email = (!is_null($json) && isset($params->email) ? $params->email : null);
        $name = (!is_null($json) && isset($params->name) ? $params->name : null);
        $surname = (!is_null($json) && isset($params->surname) ? $params->surname : null);
        $role = 'ROLE_USER';
        $password = (!is_null($json) && isset($params->password) ? $params->password : null);
        if (!is_null($email) && !is_null($name) && !is_null($password)) {
            //crear usuario
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->surname = $surname;
            $user->role = $role;
            $pwd = hash('sha256', $password);
            $user->password = $pwd;

            //comprobar usuario dublicado
            $isset_user = User::where('email', $email)->first();
            //$isset_user = DB::table('users')->where('email', $email)->first();
            if (count($isset_user) == 0) {
                //guardar usuario
                $user->save();

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Usuario registrado correctamente!',
                );
            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Usuario duplicado, no puede registrarse',
                );
            }
        } else {
            $data = array(
               'status' => 'error',
               'code' => 400,
               'message' => 'Usuario no creado',
           );
        }

        return response()->json($data, 200);
    }

    public function login(Request $request)
    {
        echo 'Accion login';
        die();
    }
}
