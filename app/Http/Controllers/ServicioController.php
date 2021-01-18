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
        return view('servicios.list', ['servicios' => Servicio::whereNotNull('id')->paginate(5)]);
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
