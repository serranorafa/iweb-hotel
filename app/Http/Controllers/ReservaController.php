<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\Estancia;
use App\Servicio;
use App\Temporada;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function createRoomForm() 
    {
        $habitaciones = array();

        return view('reservas.createRoom', ['habitaciones' => $habitaciones]);
    }

    public function buscarHabitaciones() 
    {
        $habitaciones = Estancia::whereNotNull('id')
                            ->where('tipo', 'HABITACION')
                            ->when(request()->input('plazas'), function($query) {
                                $query->where('plazas', request()->input('plazas'));
                            })
                            ->when(request()->input('vistas'), function($query) {
                                $query->where('vistas', request()->input('vistas'));
                            })->paginate(10);

        return view('reservas.createRoom', ['habitaciones' => $habitaciones]);
    }

    public function buscarHabitacionesPRUEBA() 
    {
        $fechaInicio = request()->input('fecha_inicio');
        $fechaFin = request()->input('fecha_fin');

        $dateTimeInicio = date('Y-m-d 17:00:00', strtotime("$fechaInicio"));
        $dateTimeFin = date('Y-m-d 12:00:00', strtotime("$fechaFin"));

        $habitaciones = Estancia::whereNotNull('id')
                            ->where('tipo', 'HABITACION')
                            ->when(request()->input('plazas'), function($query) {
                                $query->where('plazas', request()->input('plazas'));
                            })
                            ->when(request()->input('vistas'), function($query) {
                                $query->where('vistas', request()->input('vistas'));
                            })
                            ->whereNotIn('id', function($query) use($dateTimeInicio, $dateTimeFin) {
                                $query->from('bloqueos')
                                    ->select('estancia_id')
                                    ->where('fecha_inicio', '<=', $dateTimeFin)
                                    ->where('fecha_fin', '>=', $dateTimeInicio);
                            })
                            ->whereNotIn('id', function($query) use($dateTimeInicio, $dateTimeFin) {
                                $query->from('reservas')
                                    ->select('estancia_id')
                                    ->where('fecha_inicio', '<=', $dateTimeFin)
                                    ->where('fecha_fin', '>=', $dateTimeInicio);
                            })
                            ->get();

        return view('reservas.createRoom', ['habitaciones' => $habitaciones]);
    }

    public function buscarHabitacionesAjax(Request $request) 
    {
        $contenido = $request->getContent();
        $array = explode("&", $contenido);

        $fechaInicio = explode("=", $array[0])[1];
        $fechaFin = explode("=", $array[1])[1];
        $plazas = explode('=', $array[2])[1];
        $vistas = explode('=', $array[3])[1];
        $vistasString = "";
        $vistasArray = [];
        if ($vistas != "") {
            $vistasArray = explode('+', $vistas);
            $vistasString = $vistasArray[0] . " " . $vistasArray[1] . " " . $vistasArray[2];
        }

        $dateTimeInicio = date('Y-m-d 17:00:00', strtotime("$fechaInicio"));
        $dateTimeFin = date('Y-m-d 12:00:00', strtotime("$fechaFin"));

        $habitaciones = Estancia::whereNotNull('id')
                            ->where('tipo', 'HABITACION')
                            ->when($plazas, function($query) use ($plazas) {
                                $query->where('plazas', $plazas);
                            })
                            ->when($vistas, function($query) use($vistasString) {
                                $query->where('vistas', $vistasString);
                            })
                            ->whereNotIn('id', function($query) use($dateTimeInicio, $dateTimeFin) {
                                $query->from('bloqueos')
                                    ->select('estancia_id')
                                    ->where('fecha_inicio', '<=', $dateTimeFin)
                                    ->where('fecha_fin', '>=', $dateTimeInicio);
                            })
                            ->whereNotIn('id', function($query) use($dateTimeInicio, $dateTimeFin) {
                                $query->from('reservas')
                                    ->select('estancia_id')
                                    ->where('fecha_inicio', '<=', $dateTimeFin)
                                    ->where('fecha_fin', '>=', $dateTimeInicio);
                            })
                            ->get();

        return response()->json(['habitaciones' => $habitaciones]);
    }

    public function created(Request $request) 
    {
        $reserva = new Reserva();

        $contenido = $request->getContent();
        $array = explode("&", $contenido);

        $fechaInicio = explode("=", $array[0])[1];
        $fechaFin = explode("=", $array[1])[1];
        $estancia = explode('=', $array[2])[1];
        $servicio = explode('=', $array[3])[1];

        $fechaInicioComparacion = "2020" . substr($fechaInicio, 4);
        $fechaInicioComparacionDate = new DateTime($fechaInicioComparacion);
        $temporadas = Temporada::all();

        $temporadaReserva = 1;

        $FI = strtotime($fechaInicio);
        $FF = strtotime($fechaFin);

        $numDias = ($FF - $FI) / (60 * 60 * 24);

        foreach ($temporadas as $temporada) {
            if (($fechaInicioComparacionDate->format('Y-m-d') >= $temporada->getFechaInicio()) && ($fechaInicioComparacionDate->format('Y-m-d') <= $temporada->getFechaFin())) {
                $temporadaReserva = $temporada->getId();
            }
        }

        $idServicio = Servicio::where('nombre', $servicio)->firstOrFail()->getId();

        $dateTimeInicio = date('Y-m-d 17:00:00', strtotime("$fechaInicio"));
        $dateTimeFin = date('Y-m-d 12:00:00', strtotime("$fechaFin"));

        $reserva->setFechaInicio($dateTimeInicio);
        $reserva->setFechaFin($dateTimeFin);
        $reserva->setEstancia($estancia);
        $reserva->setServicio($idServicio);
        $reserva->setTemporada($temporadaReserva);
        $reserva->setUsuario(Auth::user()->id);
        $tarifaBase = Estancia::find($estancia)->getTarifaBase();
        $tarifaServicio = Servicio::find($idServicio)->getTarifa();
        $modTemporada = Temporada::find($temporadaReserva)->getModificador();
        $precioTotal = $numDias * ($tarifaBase + $tarifaServicio) * $modTemporada;
        $reserva->setPrecioTotal($precioTotal);

        $reserva->save();
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