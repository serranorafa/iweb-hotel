<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bloqueo;
use App\Estancia;
use Illuminate\Support\Facades\DB;
class BloqueoController extends Controller
{
    /**
     * Show the user list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $listaResultado = Bloqueo::whereNotNull('id')
            ->when(request()->input('id'), function($query) {
                $query->where('id', request()->input('id'));
            })
            ->when(request()->input('fecha_inicio'), function($query) {
                $query->whereDate('fecha_inicio', request()->input('fecha_inicio'));
            })
            ->when(request()->input('fecha_fin'), function($query) {
                $query->whereDate('fecha_fin', request()->input('fecha_fin'));
            })
            ->whereHas('getEstancia', function($query) use($request) {
                if ($request->input('estancia_numero')) {
                    $query->where('numero', $request->input('estancia_numero'));
                }
            })->paginate(5);

        return view('bloqueos.list', ['bloqueos' => $listaResultado]);
    }

    public function details($id)
    {
        $bloqueo = Bloqueo::find($id);
        return view('bloqueos.details', ['bloqueo' => $bloqueo]);
    }

    public function createForm()
    {
        return view('bloqueos.create', ['estancias' => Estancia::whereNotNull('id')->get()]);
    }

    public function created(Request $request) 
    {
        $bloqueo = new Bloqueo();

        $fechaInicio = $request->input('fecha_inicio');
        $horaInicio = $request->input('hora_inicio');
        $fechaFin = $request->input('fecha_fin');
        $horaFin = $request->input('hora_fin');
        
        $dateTimeInicio = date('Y-m-d H:i:s', strtotime("$fechaInicio $horaInicio"));
        $dateTimeFin = date('Y-m-d H:i:s', strtotime("$fechaFin $horaFin"));

        $bloqueo->setEstancia($request->input('estancia_id'));
        $bloqueo->setFechaInicio($dateTimeInicio);
        $bloqueo->setFechaFin($dateTimeFin);

        $bloqueo->save();

        return redirect()->action('BloqueoController@index', ['bloqueos' => Bloqueo::whereNotNull('id')->paginate(5)]);
    }

    public function edit($id)
    {
        $bloqueo = Bloqueo::find($id);
        return view('bloqueos.edit', ['bloqueo' => $bloqueo, 'estancias' => Estancia::whereNotNull('id')->get()]);
    }

    public function edited(Request $request)
    {
        $bloqueo = Bloqueo::find($request->input('id'));

        $fechaInicio = $request->input('fecha_inicio');
        $horaInicio = $request->input('hora_inicio');
        $fechaFin = $request->input('fecha_fin');
        $horaFin = $request->input('hora_fin');
        
        $dateTimeInicio = date('Y-m-d H:i:s', strtotime("$fechaInicio $horaInicio"));
        $dateTimeFin = date('Y-m-d H:i:s', strtotime("$fechaFin $horaFin"));

        $bloqueo->setEstancia($request->input('estancia_id'));
        $bloqueo->setFechaInicio($dateTimeInicio);
        $bloqueo->setFechaFin($dateTimeFin);

        $bloqueo->save();

        return redirect()->action('BloqueoController@index', ['bloqueos' => Bloqueo::whereNotNull('id')->paginate(5)]);
    }

    public function delete($id)
    {
        $bloqueo = Bloqueo::find($id);
        $bloqueo->delete();

        return redirect()->action('BloqueoController@index', ['bloqueos' => Bloqueo::whereNotNull('id')->paginate(5)]);
    }
}
