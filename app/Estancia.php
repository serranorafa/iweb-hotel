<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    public function Bloqueos() {
        return $this->hasMany('App\Bloqueo');
    }

    public function Fotos() {
        return $this->hasMany('App\Foto');
    }

    public function getId() {
        return $this->id;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getPlanta() {
        return $this->planta;
    }

    public function setPlanta($planta) {
        $this->planta = $planta;
    }

    public function getPlazas() { 
        return $this->plazas;
    }

    public function setPlazas($plazas) {
        $this->plazas = $plazas;
    }

    public function getVistas() {
        return $this->vistas;
    }

    public function setVistas($vistas) {
        $this->vistas = $vistas;
    }

    public function getAforo() {
        return $this->aforo;
    }

    public function setAforo($aforo) {
        $this->aforo = $aforo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    public function getTarifaBase() {
        return $this->tarifa_base;
    }

    public function setTarifaBase($tarifa_base) {
        $this->tarifa_base = $tarifa_base;
    }

    public function getReservas() {
        return $this->belongsToMany('App\Reserva');
    }

    public function disponible($fecha_inicio, $fecha_fin) {
        foreach($this->Bloqueos() as $bloqueo) {
            if ($fecha_inicio <= $bloqueo->fecha_fin && $fecha_fin >= $bloqueo->fecha_inicio) {
                return false;
            }
        }

        foreach($this->getReservas() as $reserva) {
            if ($fecha_inicio <= $reserva->fecha_fin && $fecha_fin >= $reserva->fecha_inicio) {
                return false;
            }
        }

        return true;
    }
}
