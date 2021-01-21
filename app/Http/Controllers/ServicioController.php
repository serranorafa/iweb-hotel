<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\Estancia;
use Illuminate\Support\Facades\DB;
class ServicioController extends Controller
{
    /**
     * Show the user list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listaResultado = Servicio::whereNotNull('id')
            ->when(request()->input('id'), function($query) {
                $query->where('id', request()->input('id'));
            })
            ->when(request()->input('nombre'), function($query) {
                $query->where('nombre', 'LIKE', '%'.request()->input('nombre').'%');
            })
            ->when(request()->input('tarifa'), function($query) {
                $query->where('tarifa', request()->input('comparacion'), request()->input('tarifa'));
            })->paginate(5);
            
        return view('servicios.list', ['servicios' => $listaResultado]);
    }

    public function details($id)
    {
        $servicio = Servicio::find($id);
        return view('servicios.details', ['servicio' => $servicio]);
    }

    public function createForm()
    {
        return view('servicios.create');
    }

    public function created(Request $request)
    {
        $servicio = new Servicio();

        $servicio->setNombre($request->input('nombre'));
        $servicio->setDescripcion($request->input('descripcion'));
        $servicio->setTarifa($request->input('tarifa'));

        $servicio->save();

        return redirect()->action('ServicioController@index', ['servicios' => Servicio::whereNotNull('id')->paginate(5)]);
    }

    public function descripcion($nombre) 
    {
        return Servicio::where('nombre', $nombre)->firstOrFail();
    }

    public function edit($id)
    {
        $servicio = Servicio::find($id);
        return view('servicios.edit', ['servicio' => $servicio]);
    }

    public function edited(Request $request) 
    {
        $servicio = Servicio::find($request->input('id'));

        $servicio->setNombre($request->input('nombre'));
        $servicio->setDescripcion($request->input('descripcion'));
        $servicio->setTarifa($request->input('tarifa'));

        $servicio->save();

        return redirect()->action('ServicioController@index', ['servicios' => Servicio::whereNotNull('id')->paginate(5)]);
    }

    public function delete($id) 
    {
        $servicio = Servicio::find($id);
        $servicio->delete();
        
        return redirect()->action('ServicioController@index', ['servicios' => Servicio::whereNotNull('id')->paginate(5)]);
    }
}
