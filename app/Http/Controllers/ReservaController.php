<?php

namespace App\Http\Controllers;

use App\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        return view('reservas.list', ['reservas' => Reserva::whereNotNull('id')->paginate(5)]);
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