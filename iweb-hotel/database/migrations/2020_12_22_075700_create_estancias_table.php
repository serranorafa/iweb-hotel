<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estancias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero');
            $table->string('tipo');
            $table->integer('planta');
            $table->integer('plazas');
            $table->string('vistas');
            $table->integer('aforo');
            $table->string('descripcion');
            $table->integer('tarifa_base');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estancias');
    }
}
