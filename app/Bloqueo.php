<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloqueo extends Model
{
    public function getEstancia() {
        return $this->belongsTo('App\Estancia', 'estancia_id');
    }

    public function setEstancia($estancia) {
        $this->estancia_id = $estancia;
    }

    public function getId() {
        return $this->id;
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
}
