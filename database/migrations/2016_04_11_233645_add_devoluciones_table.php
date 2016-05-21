<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDevolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha');
            $table->double('kilometrajeActual',12,3);
            $table->string('estadoVehiculo');
            $table->string('observaciones')->nullable();
            $table->integer('horasDeUso');
            $table->integer('valorPagado');
            $table->integer('bono');

            $table->integer('renta_id')->unsigned();

            $table->foreign('renta_id')->references('id')->on('rentas')->onDelete('cascade');

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
        Schema::drop('devoluciones');
    }
}
