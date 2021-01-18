<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    public function getReservas() { 
        return $this->belongsToMany('App\Reserva');
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getTarifa() { 
        return $this->tarifa;
    }

    public function setTarifa($tarifa) {
        $this->tarifa = $tarifa;
    }
}
