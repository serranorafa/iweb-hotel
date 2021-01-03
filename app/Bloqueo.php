<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloqueo extends Model
{
    public function Estancia() {
        return $this->belongsTo('App\Estancia');
    }
}
