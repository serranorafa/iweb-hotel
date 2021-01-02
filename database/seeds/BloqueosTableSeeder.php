<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloqueosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bloqueos')->delete();

        factory(App\Bloqueo::class, 50)->create();
    }
}
