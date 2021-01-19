<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reserva;
use Faker\Generator as Faker;

$factory->define(Reserva::class, function (Faker $faker) {
    return [
        'temporada_id' => $faker->numberBetween($min = 1, $max = 4),
        'usuario_id' => $faker->numberBetween($min = 1, $max = 50),
        'fecha_inicio' => $faker->dateTimeInInterval($startDate = '-3 days', $interval = '+ 3 days', $timezone = null),
        'fecha_fin' => $faker->dateTimeInInterval($startDate = '-0 days', $interval = '+ 3 days', $timezone = null),
        'precio_total' => $faker->numberBetween($min = 30, $max = 1000),
    ];
});
