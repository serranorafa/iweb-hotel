<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    public function getBloqueos() {
        return $this->hasMany('App\Bloqueo');
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

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }
    
    public function getTarifaBase() {
        return $this->tarifa_base;
    }

    public function setTarifaBase($tarifa_base) {
        $this->tarifa_base = $tarifa_base;
    }
}
