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

    public function created(Request $request) 
    {
        $temporada = new Temporada();

        $temporada->setNombre($request->input('nombre'));
        $temporada->setFechaInicio($request->input('fecha_inicio'));
        $temporada->setFechaFin($request->input('fecha_fin'));
        $temporada->setModificador($request->input('mod_temporada'));

        $temporada->save();

        return redirect()->action('TemporadaController@index', ['temporadas' => Temporada::whereNotNull('id')->paginate(5)]);
    }

    public function edit($id)
    {
        $temporada = Temporada::find($id);
        return view('temporadas.edit', ['temporada' => $temporada]);
    }

    public function edited(Request $request) 
    {
        $temporada = Temporada::find($request->input('id'));

        $temporada->setNombre($request->input('nombre'));
        $temporada->setFechaInicio($request->input('fecha_inicio'));
        $temporada->setFechaFin($request->input('fecha_fin'));
        $temporada->setModificador($request->input('mod_temporada'));

        $temporada->save();

        return redirect()->action('TemporadaController@index', ['temporadas' => Temporada::whereNotNull('id')->paginate(5)]);
    }

    public function delete($id) 
    {
        $temporada = Temporada::find($id);
        $temporada->delete();
        
        return redirect()->action('TemporadaController@index', ['temporadas' => Temporada::whereNotNull('id')->paginate(5)]);
    }
}
