<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    public function getReservas() { 
        return $this->belongsToMany('App\Reserva');
    }
}
