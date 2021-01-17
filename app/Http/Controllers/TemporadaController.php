<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temporada;
use Illuminate\Support\Facades\DB;
class TemporadaController extends Controller
{
    /**
     * Show the user list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('temporadas.list', ['temporadas' => Temporada::whereNotNull('id')->paginate(5)]);
    }
    public function details($id)
    {
        $temporada = Temporada::find($id);
        return view('temporadas.details', ['temporada' => $temporada]);
    }
    public function createForm()
    {
        return view('temporadas.create');
    }
    public function edit($id)
    {
        $temporada = Temporada::find($id);
        return view('temporadas.edit', ['temporada' => $temporada]);
    }
}
