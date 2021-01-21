<?php

namespace App\Http\Controllers;

use App\Estancia;
use App\Foto;
use Illuminate\Http\Request;

class EstanciaController extends Controller
{
    /**
     * Mensajes de error
     */
    public $customMessages = [
        'image' => 'Las fotos deben ser archivos con formato de imagen (jpeg, png, bmp, gif, svg o webp).',
        'mimes' => 'Las fotos deben ser archivos con formato de imagen (jpeg, png, bmp, gif, svg o webp).'
    ];

    public function index(Request $request) 
    {
        $listaResultado = Estancia::whereNotNull('id')
                            ->when($request->input('numero'), function($query) {
                                $query->where('numero', request()->input('numero'));
                            })
                            ->when($request->input('planta'), function($query) {
                                $query->where('planta', request()->input('planta'));
                            })
                            ->when($request->input('comparacion'), function($query) {
                                $query->where('tipo', request()->input('comparacion'));
                            })
                            ->when($request->input('plazas'), function($query) {
                                $query->where('plazas', request()->input('plazas'));
                            })
                            ->when($request->input('tarifa_base'), function($query) {
                                $query->where('tarifa_base', request()->input('tarifa_base'));
                            })
                            ->when($request->input('aforo'), function($query) {
                                $query->where('aforo', '>=', request()->input('aforo'));
                            })->paginate(5);
        return view('estancias.list', ['estancias' => $listaResultado]);
    }

    public function createForm()
    {
        return view('estancias.create');
    }

    public function created(Request $request) 
    {
        $rules = [
            'fotos.*' => 'mimes:jpg,png,jpeg,gif,svg,webp',
        ];
        $this->validate($request, $rules, $this->customMessages);
        
        $estancia = new Estancia();

        $tipo = $request->input('tipo');
        $estancia->setTipo($tipo);
        $estancia->setNumero($request->input('numero'));
        $estancia->setDescripcion($request->input('descripcion'));
        $estancia->setTarifaBase($request->input('tarifa_base'));

        if ($tipo == 'SALA') {
            $estancia->setAforo($request->input('aforo'));
            $estancia->setPlazas(0);
            $estancia->setVistas("");
        } else {
            $estancia->setAforo(0);
            $estancia->setPlazas($request->input('plazas'));
            $estancia->setVistas($request->input('vistas'));
        }
        $estancia->setPlanta($request->input('planta'));

        $estancia->save();

        $fotos = $request->file('fotos');

        if ($request->hasFile('fotos')) {
            foreach ($fotos as $foto) {
                $foto->storeAs("/img/estancias/", $foto->getClientOriginalName(), 'public');

                $nuevaFoto = new Foto();
                $nuevaFoto->setEstancia($estancia->getId());
                $nuevaFoto->setRuta($foto->getClientOriginalName());

                $nuevaFoto->save();
            }
        }
        return redirect()->action('EstanciaController@index', ['estancias' => Estancia::whereNotNull('id')->paginate(5)]);
    }

    public function details($id)
    {
        $estancia = Estancia::find($id);

        $dir = '/img/estancias/';

        return view('estancias.details', ['estancia' => $estancia, 'dir' => $dir]);
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
            $estancia->setPlazas(0);
            $estancia->setVistas("");
        } else {
            $estancia->setAforo(0);
            $estancia->setPlazas($request->input('plazas'));
            $estancia->setVistas($request->input('vistas'));
        }
        
        $estancia->setPlanta($request->input('planta'));
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
