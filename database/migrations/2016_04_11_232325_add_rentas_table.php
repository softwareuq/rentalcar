<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha');
            $table->double('kilometrajeActual',12,3);
            $table->enum('estado',['pedido','entregado','cancelado'])->default('pedido');;

            $table->integer('usuario_id')->unsigned();
            $table->integer('vehiculo_id')->unsigned();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade');

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
        Schema::drop('rentas');
    }
}
