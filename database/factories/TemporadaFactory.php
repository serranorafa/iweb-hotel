<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Temporada;
use Faker\Generator as Faker;

$factory->define(Temporada::class, function (Faker $faker) {
    $temporadas = array("Verano", "Otonyo", "Primavera", "Invierno");

    return [
        'nombre' => $temporadas[$faker->numberBetween($min = 0, $max = 3)],
        'fecha_inicio' => $faker->dateTime($min = 'now'),
        'fecha_fin' => $faker->dateTime($min = 'now'),
        'mod_temporada' => $faker->randomFloat($min = 1, $max = 3)
    ];
});
