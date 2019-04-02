<?php

namespace App\Http\Controllers;

use App\Helpers\JwtAuth;
use Validator;
use Symfony\Component\HttpFoundation\Request;
use App\Car;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $hash = $request->header('Autorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if ($checkToken) {
            echo 'index de Carcontroller autentificado';
            die();
        } else {
            echo 'no autenticado';
            die();
        }
    }

    public function store(Request $request)
    {
        $hash = $request->header('Autorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if ($checkToken) {
            //recoger datos por post
            $json = $request->input('json', null);
            $params = json_decode($json);
            $params_array = json_decode($json, true);

            //conseguir el usuario identificado
            $user = $jwtAuth->checkToken($hash, true);
            //validacion

            $validate = Validator::make($params_array, [
                'title' => 'required|min:5',
                'descripcion' => 'required',
                'price' => 'required',
                'status' => 'required',
            ]);

            if ($validate->fail()) {
                return response()->json($validate->errors(), 400);
            }

            //Guardar el coche
            //solo si se hace con $validate //if (isset($params->title) && isset($params->description) && isset($params->price) && isset($params->status)) {
            $car = new Car();
            $car->user_id = $user->sub;
            $car->title = $params->title;
            $car->descripcion = $params->descripcion;
            $car->price = $params->price;
            $car->statusc = $params->statusc;
            // }
            $car->save();

            $data = array(
                'car' => $car,
                'status' => 'success',
                'code' => 200,
            );
        } else {
            //devolver error
            $data = array(
                'message' => 'Login inconrrecto!',
                'status' => 'success',
                'code' => 300,
            );
        }

        return response()->json($data, 200);
    }

    //end store
}//end class
