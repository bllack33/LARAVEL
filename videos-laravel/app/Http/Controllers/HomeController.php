<?php

namespace App\Http\Controllers;

use App\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //este metodo se usa si no se importa el modelo 'use App\Video;'
        //$videos = DB::table('videos')->paginate(5);

        $videos = Video::orderBy('id', 'desc')->paginate(5);

        return view('home', compact('videos'));
    }
}
