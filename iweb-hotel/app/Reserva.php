<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public function getUsuario() {
        return $this->belongsTo('App\User', 'usuario_id');
    }

    public function getTemporada() {
        return $this->belongsTo('App\Temporada', 'temporada_id');
    }

    public function getServicios() { 
        return $this->belongsToMany('App\Servicio');
    }

    public function getEstancias() { 
        return $this->belongsToMany('App\Estancia');
    }
}
