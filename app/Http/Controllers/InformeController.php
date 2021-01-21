<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estancia;
use App\Reserva;
use App\User;
use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Facades\DB;
class InformeController extends Controller
{
    /**
     * Show the user list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $label = "";
        $entradas = array();
        if(request()->input('anyo_inicio')){
            $begin = new DateTime(request()->input('anyo_inicio') . "-" . request()->input('mes_inicio') . "-01");
            $beginm = $begin;
            $beginm->add(DateInterval::createFromDateString('1 month'));
            $end = new DateTime(request()->input('anyo_fin') . "-" . request()->input('mes_fin') . "-01");
            $end = $end->modify('+1 month');
            $interval = DateInterval::createFromDateString('1 month');
            $intervalm = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);
            $periodm = new DatePeriod($begin, $intervalm, $beginm);
            /*
            foreach ($period as $dt) {
                echo $dt->format("l Y-m-d H:i:s\n");
            }*/
            if(request()->input('tipo') == "RESERVAS"){
                foreach ($period as $dt) {
                    $label = "Euros";
                    $dtend = date('Y-m-d 00:00:00', strtotime("+1 month", strtotime($dt->format('Y-m-d'))));
                    $entradas[$dt->format('M Y')] = Reserva::where('created_at', '>=', $dt)->where('created_at', '<=', $dtend)->sum('precio_total');
                }
                return view('informes.chart', ['entradas' => $entradas, 'label' => $label]);
            }
            else if(request()->input('tipo') == "OCUPACION"){
                $label = "% de ocupación";
                error_log($begin->format('d m Y') . " " . $beginm->format('d m Y'));
                /*
                foreach ($periodm as $dt) {
                    $numReservasHoy = Reserva::where('fecha_inicio', '>=', $dt)
                    ->where('fecha_fin', '<=', $dt)
                    ->count();
                    error_log($dt->format('d m Y'));
                    $porcentajeOcupadoDiaActual = $numReservasHoy / Estancia::all()->count() * 100;
                    $entradas[$dt->format('d M Y')] = $porcentajeOcupadoDiaActual;
                }
                */
                return view('informes.chart', ['entradas' => $entradas, 'label' => $label]);
    
            }else if(request()->input('tipo') == "REGISTROS"){
                $label = "Usuarios registrados";
                foreach ($period as $dt) {
                    $dtend = date('Y-m-d 00:00:00', strtotime("+1 month", strtotime($dt->format('Y-m-d'))));
                    $entradas[$dt->format('M Y')] = User::where('created_at', '>=', $dt)->where('created_at', '<=', $dtend)->count();
                }
                return view('informes.chart', ['entradas' => $entradas, 'label' => $label]);
            }
        }
        return view('informes.chart', ['entradas' => $entradas, 'label' => $label]);
    }
}
