<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\Estancia;
use App\Servicio;
use App\Temporada;
use App\User;
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
            });
        
        if (request()->user()->rol == "CLIENTE") {
            $listaResultado->where('usuario_id', request()->user()->id);
        }

        return view('reservas.list', ['reservas' => $listaResultado->paginate(5)]);
    }

    public function createRoomForm() 
    {
        $usuarios = User::orderBy('email', 'ASC')->get();
        $reserva = new Reserva();

        return view('reservas.createRoom', ['usuarios' => $usuarios, 'reserva' => $reserva]);
    }

    public function createHallForm() 
    {
        $usuarios = User::orderBy('email', 'ASC')->get();

        return view('reservas.createHall', ['usuarios' => $usuarios]);
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

    public function buscarSalasAjax(Request $request)
    {
        $contenido = $request->getContent();
        $array = explode("&", $contenido);

        $fechaInicio = explode("=", $array[0])[1];
        $fechaFin = explode("=", $array[1])[1];
        $horaInicio = explode('=', $array[2])[1];
        $horaFin = explode('=', $array[3])[1];
        $aforo = explode('=', $array[4])[1];

        $horaInicioHora = explode("%3A", $horaInicio)[0];
        $horaFinHora = explode("%3A", $horaFin)[0];

        $horaInicioMinuto = explode("%3A", $horaInicio)[1];
        $horaFinMinuto = explode("%3A", $horaFin)[1];

        $horaInicioFinal = $horaInicioHora . ":" . $horaInicioMinuto;
        $horaFinFinal = $horaFinHora . ":" . $horaFinMinuto;

        $dateTimeInicio = date('Y-m-d H:i:s', strtotime("$fechaInicio $horaInicioFinal"));
        $dateTimeFin = date('Y-m-d H:i:s', strtotime("$fechaFin $horaFinFinal"));

        $salas = Estancia::whereNotNull('id')
                            ->where('tipo', 'SALA')
                            ->when($aforo, function($query) use ($aforo) {
                                $query->where('aforo', '>=', $aforo);
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

        return response()->json(['salas' => $salas]);
    }

    public function created(Request $request) 
    {
        $reserva = new Reserva();

        $contenido = $request->getContent();
        error_log($contenido);
        $array = explode("&", $contenido);

        $fechaInicio = explode("=", $array[0])[1];
        $fechaFin = explode("=", $array[1])[1];

        if (count($array) == 6) {
            $estancia = explode('=', $array[2])[1];
            $servicio = explode('=', $array[3])[1];
            $usuario = explode('=', $array[4])[1];

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
            $modTemporada = Temporada::find($temporadaReserva)->getModificador();
        } else {
            $horaInicio = explode("=", $array[2])[1];
            $horaFin = explode("=", $array[3])[1];
            $estancia = explode('=', $array[4])[1];
            $servicio = explode('=', $array[5])[1];
            $usuario = explode('=', $array[6])[1];
            $idServicio = Servicio::where('nombre', $servicio)->firstOrFail()->getId();

            $horaInicioHora = explode("%3A", $horaInicio)[0];
            $horaFinHora = explode("%3A", $horaFin)[0];

            $horaInicioMinuto = explode("%3A", $horaInicio)[1];
            $horaFinMinuto = explode("%3A", $horaFin)[1];

            $horaInicioFinal = $horaInicioHora . ":" . $horaInicioMinuto;
            $horaFinFinal = $horaFinHora . ":" . $horaFinMinuto;

            $dateTimeInicio = date('Y-m-d H:i:s', strtotime("$fechaInicio $horaInicioFinal"));
            $dateTimeFin = date('Y-m-d H:i:s', strtotime("$fechaFin $horaFinFinal"));

            $dateTimeInicioFecha = strtotime($dateTimeInicio);
            $dateTimeFinFecha = strtotime($dateTimeFin);

            $numHoras = ($dateTimeFinFecha - $dateTimeInicioFecha) / (60 * 60);

            $reserva->setFechaInicio($dateTimeInicio);
            $reserva->setFechaFin($dateTimeFin);
            $reserva->setEstancia($estancia);
            $reserva->setServicio($idServicio);
            $reserva->setTemporada(1);
        }
        if ($usuario == "") {
            $reserva->setUsuario(Auth::user()->id);
        } else if ($usuario == "anonimo") {
            //$reserva->setUsuario(Auth::user()->id);
        } else {
            $reserva->setUsuario($usuario);
        }
        $tarifaBase = Estancia::find($estancia)->getTarifaBase();
        $tarifaServicio = Servicio::find($idServicio)->getTarifa();

        if (count($array) == 6) {
            $precioTotal = $numDias * ($tarifaBase + $tarifaServicio) * $modTemporada;
        } else {
            $precioTotal = $numHoras * ($tarifaBase + $tarifaServicio);
        }
        $reserva->setPrecioTotal($precioTotal);

        $reserva->save();
    }

    public function calcularModTemporada(Request $request) 
    {
        $contenido = $request->getContent();
        
        $array = explode("&", $contenido);
        $fechaInicio = explode("=", $array[0])[1];
        $fechaFin = explode("=", $array[1])[1];
        $numHoras = 0;

        if (count($array) == 5) {
            $horaInicio = explode("=", $array[2])[1];
            $horaFin = explode("=", $array[3])[1];

            $horaInicioHora = explode("%3A", $horaInicio)[0];
            $horaFinHora = explode("%3A", $horaFin)[0];

            $horaInicioMinuto = explode("%3A", $horaInicio)[1];
            $horaFinMinuto = explode("%3A", $horaFin)[1];

            $horaInicioFinal = $horaInicioHora . ":" . $horaInicioMinuto;
            $horaFinFinal = $horaFinHora . ":" . $horaFinMinuto;

            $dateTimeInicio = date('Y-m-d H:i:s', strtotime("$fechaInicio $horaInicioFinal"));
            $dateTimeFin = date('Y-m-d H:i:s', strtotime("$fechaFin $horaFinFinal"));

            $dateTimeInicioFecha = strtotime($dateTimeInicio);
            $dateTimeFinFecha = strtotime($dateTimeFin);

            $numHoras = ($dateTimeFinFecha - $dateTimeInicioFecha) / (60 * 60);
        }

        $fechaInicioComparacion = "2020" . substr($fechaInicio, 4);
        $fechaInicioComparacionDate = new DateTime($fechaInicioComparacion);
        $temporadas = Temporada::all();

        foreach ($temporadas as $temporada) {
            if (($fechaInicioComparacionDate->format('Y-m-d') >= $temporada->getFechaInicio()) && ($fechaInicioComparacionDate->format('Y-m-d') <= $temporada->getFechaFin())) {
                $temporadaReserva = $temporada->getId();
            }
        }

        $FI = strtotime($fechaInicio);
        $FF = strtotime($fechaFin);

        $numDias = ($FF - $FI) / (60 * 60 * 24);

        $modTemporada = Temporada::find($temporadaReserva)->getModificador();

        return response()->json(['modTemporada' => $modTemporada, 'numDias' => $numDias, 'numHoras' => $numHoras]);
    }

    public function details($id)
    {
        $reserva = Reserva::find($id);
        return view('reservas.details', ['reserva' => $reserva]);
    }

    public function delete($id)
    {
        $reserva = Reserva::find($id);
        $reserva->delete();

        return redirect()->action('ReservaController@index', ['reservas' => Reserva::whereNotNull('id')->paginate(5)]);
    }
}