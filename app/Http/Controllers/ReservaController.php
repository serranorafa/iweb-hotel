<?php

namespace App\Http\Controllers;

use App\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $listaResultado = Reserva::whereNotNull('id')
            ->when(request()->input('id'), function($query) {
                $query->where('id', request()->input('id'));
            })
            ->when(request()->input('precio_total'), function($query) {
                $query->where('precio_total', request()->input('comparacion'), request()->input('precio_total'));
            })
            ->when(request()->input('fecha_inicio'), function($query) {
                $query->whereDate('fecha_inicio', request()->input('fecha_inicio'));
            })
            ->when(request()->input('fecha_fin'), function($query) {
                $query->whereDate('fecha_fin', request()->input('fecha_fin'));
            })->paginate(5);

        return view('reservas.list', ['reservas' => $listaResultado]);
    }

    public function createForm() 
    {
        return view('reservas.create');
    }

    public function created(Request $request) 
    {
        $reserva = new Reserva();



        return redirect()->action('ReservaController@index', ['reservas' => Reserva::whereNotNull('id')->paginate(5)]);
    }

    public function details($id)
    {
        $reserva = Reserva::find($id);
        return view('reservas.details', ['reserva' => $reserva]);
    }

    public function edit($id)
    {
        $reserva = Reserva::find($id);
        return view('reservas.edit', ['reserva' => $reserva]);
    }

    public function edited(Request $request)
    {
        $reserva = Reserva::find($request->input('id'));

        

        return redirect()->action('ReservaController@index', ['reservas' => Reserva::whereNotNull('id')->paginate(5)]);
    }

    public function delete($id)
    {
        $reserva = Reserva::find($id);
        $reserva->delete();

        return redirect()->action('ReservaController@index', ['reservas' => Reserva::whereNotNull('id')->paginate(5)]);
    }
}