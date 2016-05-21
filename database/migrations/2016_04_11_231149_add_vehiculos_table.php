<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('placa');
            $table->string('nombreFoto');
            $table->integer('precioAlquiler');
            $table->integer('capacidad');
            $table->string('modelo');
            $table->boolean('disponible')->default(true);
            $table->string('color');
            $table->double('kilometraje',12,3);

            $table->integer('marca_id')->unsigned();
            $table->integer('tipo_id')->unsigned();

            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');

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
        Schema::drop('vehiculos');
    }
}
