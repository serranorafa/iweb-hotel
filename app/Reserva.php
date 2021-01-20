<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reserva extends Model
{
    public function getId() {
        return $this->id();
    }

    public function getFechaInicio() {
        return $this->fecha_inicio;
    }

    public function setFechaInicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function getFechaFin() {
        return $this->fecha_fin;
    }

    public function setFechaFin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }

    public function getPrecioTotal() {
        return $this->precio_total;
    }

    public function setPrecioTotal($precio_total) {
        $this->precio_total = $precio_total;
    }

    public function getUsuario() {
        return $this->belongsTo('App\User', 'usuario_id');
    }

    public function setUsuario($usuario) {
        $this->usuario_id = $usuario;
    }

    public function getTemporada() {
        return $this->belongsTo('App\Temporada', 'temporada_id');
    }

    public function setTemporada($temporada) {
        $this->temporada_id = $temporada;
    }

    public function getServicios() { 
        return $this->belongsToMany('App\Servicio');
    }

    public function setServicios($servicios) {
        $i = 0;
        
        foreach ($servicios as $servicio) {
            if ($i == count($servicios) -1) {
                break;
            }
            // REVISAR ESTO
            $s = Servicio::find($servicio);

            DB::table('reserva_servicio')->insert([
                'reserva_id' => $this->id,
                'servicio_id' => $s->id
            ]);
            $i++;
        }
    }

    public function getEstancia() {
        return $this->belongsTo('App\Estancia', 'estancia_id');
    }

    public function setEstancia($estancia_id) {
        $this->estancia_id = $estancia_id;
    }
}
