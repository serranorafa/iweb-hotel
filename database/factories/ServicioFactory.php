<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Servicio;
use Faker\Generator as Faker;

$factory->define(Servicio::class, function (Faker $faker) {
    $servicios = array("Solo alojamiento", "Alojamiento y desayuno", "Media pension", "Pension completa", "Minibar");
    return [
        'nombre' => $servicios[$faker->numberBetween($min = 0, $max = 4)],
        'descripcion' => $faker->text($maxNbChars = 70),
        'tarifa' => $faker->numberBetween($min = 5, $max = 50)
    ];
});
