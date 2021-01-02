<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloqueo extends Model
{
    public function getEstancia() {
        return $this->belongsTo('App\Estancia');
    }
}
