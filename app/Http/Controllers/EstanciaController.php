<?php

namespace App\Http\Controllers;

use App\Estancia;
use Illuminate\Http\Request;

class EstanciaController extends Controller
{
    public function index() 
    {
        return view('estancias.list', ['estancias' => Estancia::whereNotNull('id')->paginate(5)]);
    }

    public function createForm()
    {
        return view('estancias.create');
    }

    public function created(Request $request) 
    {
        $estancia = new Estancia();

        $tipo = $request->input('tipo');
        $estancia->setTipo($tipo);
        $estancia->setNumero($request->input('numero'));
        $estancia->setDescripcion($request->input('descripcion'));
        $estancia->setTarifaBase($request->input('tarifa_base'));

        if ($tipo == 'SALA') {
            $estancia->setAforo($request->input('aforo'));
        } else {
            $estancia->setPlanta($request->input('planta'));
            $estancia->setPlazas($request->input('plazas'));
            $estancia->setVistas($request->input('vistas'));
        }

        $estancia->save();

        return redirect()->action('EstanciaController@index', ['estancias' => Estancia::whereNotNull('id')->paginate(5)]);
    }

    public function details($id)
    {
        $estancia = Estancia::find($id);
        return view('estancias.details', ['estancia' => $estancia]);
    }

    public function edit($id)
    {
        $estancia = Estancia::find($id);
        return view('estancias.edit', ['estancia' => $estancia]);
    }

    public function edited(Request $request)
    {
        $estancia = Estancia::find($request->input('id'));

        $tipo = $request->input('tipo');
        $estancia->setTipo($tipo);
        $estancia->setNumero($request->input('numero'));
        $estancia->setDescripcion($request->input('descripcion'));
        $estancia->setTarifaBase($request->input('tarifa_base'));

        if ($tipo == 'SALA') {
            $estancia->setAforo($request->input('aforo'));
        } else {
            $estancia->setPlanta($request->input('planta'));
            $estancia->setPlazas($request->input('plazas'));
            $estancia->setVistas($request->input('vistas'));
        }

        $estancia->save();

        return redirect()->action('EstanciaController@index', ['estancias' => Estancia::whereNotNull('id')->paginate(5)]);
    }

    public function delete($id)
    {
        $estancia = Estancia::find($id);
        $estancia->delete();

        return redirect()->action('EstanciaController@index', ['estancias' => Estancia::whereNotNull('id')->paginate(5)]);
    }
}
