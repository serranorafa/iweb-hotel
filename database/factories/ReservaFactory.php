<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reserva;
use Faker\Generator as Faker;

$factory->define(Reserva::class, function (Faker $faker) {
    return [
        'temporada_id' => $faker->numberBetween($min = 1, $max = 4),
        'usuario_id' => $faker->numberBetween($min = 1, $max = 50),
        'fecha_inicio' => $faker->dateTime($min = 'now'),
        'fecha_fin' => $faker->dateTime($min = 'now'),
        'precio_total' => $faker->randomFloat($min = 30, $max = 1000),
    ];
});
