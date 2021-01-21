<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservas')->delete();

        factory(App\Reserva::class, 500)->create();

        $fechaInicio = DateTime::createFromFormat('j-m-Y', '01-06-2020');
        $fechaFin = DateTime::createFromFormat('j-m-Y', '04-06-2020');

        DB::table('reservas')->insert([
            'estancia_id' => 84, 
            'servicio_id' => 3,
            'temporada_id' => 1,
            'usuario_id' => 1003,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'precio_total' => 240
        ]);

        $fechaInicio = DateTime::createFromFormat('j-m-Y', '12-10-2020');
        $fechaFin = DateTime::createFromFormat('j-m-Y', '18-10-2020');

        DB::table('reservas')->insert([
            'estancia_id' => 103, 
            'servicio_id' => 1,
            'temporada_id' => 2,
            'usuario_id' => 1003,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'precio_total' => 189
        ]);

        $fechaInicio = DateTime::createFromFormat('j-m-Y', '15-12-2020');
        $fechaFin = DateTime::createFromFormat('j-m-Y', '22-12-2020');

        DB::table('reservas')->insert([
            'estancia_id' => 24, 
            'servicio_id' => 2,
            'temporada_id' => 4,
            'usuario_id' => 1003,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'precio_total' => 208
        ]);
    }
}
