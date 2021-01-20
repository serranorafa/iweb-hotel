<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicios')->delete();

        //factory(App\Servicio::class, 10)->create();

        DB::table('servicios')->insert([
            'nombre' => 'SA', 
            'descripcion' => 'Alojamiento en el hotel sin desayunos, comidas o cenas incluidas',
            'tarifa' => 5
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'AD', 
            'descripcion' => 'Alojamiento en el hotel con derecho a desayuno en el restaurante del hotel, pero sin comidas o cenas incluidas',
            'tarifa' => 10
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'MP', 
            'descripcion' => 'Alojamiento en el hotel con derecho a desayuno y comida en el restaurante del hotel, pero sin cenas incluidas',
            'tarifa' => 18
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'PC', 
            'descripcion' => 'Alojamiento en el hotel con derecho a desayuno, comida y cena en el restaurante del hotel',
            'tarifa' => 25
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'TI', 
            'descripcion' => 'Alojamiento en el hotel con derecho a desayuno, comida y cena en el restaurante del hotel, ademas de bebidas y aperitivos gratis en el chiringuito del hotel',
            'tarifa' => 25
        ]);
    }
}
