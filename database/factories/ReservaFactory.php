<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reserva;
use Faker\Generator as Faker;

$factory->define(Reserva::class, function (Faker $faker) {
    $int = mt_rand(1577836800, 1611100800);
    $fechaInicio = date("Y-m-d H:i:s", $int);
    $dias = rand(1, 8);
    $fechaFin = date("Y-m-d H:i:s", strtotime($fechaInicio. ' + ' . $dias . ' days'));

    return [
        'temporada_id' => $faker->numberBetween($min = 1, $max = 6),
        'usuario_id' => $faker->numberBetween($min = 1, $max = 1000),
        'fecha_inicio' => $faker->dateTimeInInterval($fechaInicio),
        'fecha_fin' => $faker->dateTimeInInterval($fechaFin),
        'precio_total' => $faker->numberBetween($min = 30, $max = 1000),
        'estancia_id' => $faker->numberBetween($min = 1, $max = 250),
        'servicio_id' => $faker->numberBetween($min = 1, $max = 9)
    ];
});
