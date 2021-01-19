<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    public function Estancia() {
        return $this->belongsTo('App\Estancia', 'estancia_id');
    }

    public function setEstancia($estancia) {
        $this->estancia_id = $estancia;
    }

    public function getId() {
        return $this->id;
    }

    public function getRuta() {
        return $this->ruta;
    }

    public function setRuta($ruta) {
        $this->ruta = $ruta;
    }
}
