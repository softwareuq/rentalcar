<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cedula')->unsigned();
          $table->string('name');
          $table->integer('licencia')->unsigned();
          $table->string('telefono');
          $table->string('direccion')->nullable();
          $table->enum('tipo',['cliente','administrador'])->default('cliente');
          $table->integer('horasAcumuladas')->unsigned();
          $table->string('email');
          $table->string('password');
          $table->rememberToken();
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
        Schema::drop('users');
    }
}
