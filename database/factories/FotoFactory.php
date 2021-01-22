<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Foto;
use Faker\Generator as Faker;

$factory->define(Foto::class, function (Faker $faker) {
    $imagenes = [
        '/home/home-1.jpeg',
        '/home/home-2.jpeg',
        '/home/home-3.jpeg',
        '/others/alicante-1.jpeg',
        '/others/alicante-2.webp',
        '/others/alicante-3.jpeg',
        '/restaurant/restaurant-1.webp',
        '/restaurant/restaurant-2.webp',
        '/restaurant/restaurant-3.webp',
        '/restaurant/restaurant-4.webp',
        '/restaurant/restaurant-5.webp',
        '/restaurant/restaurant-6.webp',
        '/restaurant/restaurant-7.webp',
        '/restaurant/restaurant-8.webp',
        '/restaurant/restaurant-9.webp',
        '/room/room-1.webp',
        '/room/room-2.webp',
        '/room/room-3.jpeg',
        '/room/room-4.webp',
        '/room/room-5.webp',
        '/room/room-6.jpeg',
        '/room/room-7.webp',
        '/room/room-8.webp',
        '/room/room-9.webp',
        '/room/room-10.webp',
        '/room/room-11.webp',
        '/room/room-12.jpeg',
        '/room/room-13.webp',
        '/room/room-14.webp',
        '/room/room-15.webp',
        '/room/room-16.webp',
        '/room/room-17.webp',
        '/sala/sala-1.webp',
        '/sala/sala-2.jpeg',
        '/sala/sala-3.webp',
        '/sala/sala-4.webp',
        '/sala/sala-5.jpeg',
        '/sala/sala-6.webp',
        '/sala/sala-7.webp',
    ];
    $indice = array_rand($imagenes);

    return [
        'ruta' => $imagenes[$indice],
        'estancia_id' => $faker->numberBetween($min = 1, $max = 250)
    ];
});
