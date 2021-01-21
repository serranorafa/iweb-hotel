<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estancia;
use Faker\Generator as Faker;

$factory->define(Estancia::class, function (Faker $faker) {
    $tipoAux = $faker->boolean(20);
    $tipo = $tipoAux?"SALA":"HABITACION";
    $vistas = array("Vistas al mar", "Vistas a piscina", "Vistas al aparcamiento", "Vistas al jardin");
    return [
        'numero' => $faker->numberBetween($min = 1, $max = 10000),
        'tipo' => $tipo,
        'planta' => $faker->randomDigit,
        'plazas' => $faker->numberBetween($min = 1, $max = 4),
        'vistas' => $vistas[rand(0, 3)],
        'aforo' => $faker->numberBetween($min = 50, $max = 500),
        'descripcion' => $faker->text($maxNbChars = 70),
        'tarifa_base' => $faker->numberBetween($min = 20, $max = 100),
        //'foto' => $faker->image()
    ];
});
