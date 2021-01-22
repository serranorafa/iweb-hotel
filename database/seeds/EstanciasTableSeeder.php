<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstanciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estancias')->delete();

        factory(App\Estancia::class, 250)->create();
    }
}
