<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    public function getBloqueos() {
        return $this->hasMany('App\Bloqueo');
    }
}
