<?php

namespace App\Http\Controllers;

use App\Helpers\JwtAuth;
use Symfony\Component\HttpFoundation\Request;

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
}
