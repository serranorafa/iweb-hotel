<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $nombre = "Joan Petit";
        //return View::make('home/principal')->with('nombre', $nombre);
        return view('home.principal',['nombre'=>$nombre]);
    }
}
