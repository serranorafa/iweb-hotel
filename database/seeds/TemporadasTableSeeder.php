<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemporadasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('temporadas')->delete();

        //factory(App\Temporada::class, 7)->create();

        $fechaInicio = DateTime::createFromFormat('j-m-Y', '01-06-2020');
        $fechaFin = DateTime::createFromFormat('j-m-Y', '01-09-2020');

        DB::table('temporadas')->insert([
            'nombre' => 'Verano', 
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'mod_temporada' => 2
        ]);

        $fechaInicio = DateTime::createFromFormat('j-m-Y', '01-09-2020');
        $fechaFin = DateTime::createFromFormat('j-m-Y', '25-10-2020');

        DB::table('temporadas')->insert([
            'nombre' => 'Otoño', 
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'mod_temporada' => 1.3
        ]);

        $fechaInicio = DateTime::createFromFormat('j-m-Y', '25-10-2020');
        $fechaFin = DateTime::createFromFormat('j-m-Y', '05-11-2020');

        DB::table('temporadas')->insert([
            'nombre' => 'Halloween', 
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'mod_temporada' => 1.6
        ]);

        $fechaInicio = DateTime::createFromFormat('j-m-Y', '05-11-2020');
        $fechaFin = DateTime::createFromFormat('j-m-Y', '20-12-2020');

        DB::table('temporadas')->insert([
            'nombre' => 'Invierno', 
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'mod_temporada' => 1.2
        ]);

        $fechaInicio = DateTime::createFromFormat('j-m-Y', '20-12-2020');
        $fechaFin = DateTime::createFromFormat('j-m-Y', '07-01-2020');

        DB::table('temporadas')->insert([
            'nombre' => 'Navidad', 
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'mod_temporada' => 1.7
        ]);

        $fechaInicio = DateTime::createFromFormat('j-m-Y', '07-01-2020');
        $fechaFin = DateTime::createFromFormat('j-m-Y', '30-05-2020');

        DB::table('temporadas')->insert([
            'nombre' => 'Primavera', 
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'mod_temporada' => 1.3
        ]);
    }
}
