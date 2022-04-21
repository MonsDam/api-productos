<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('sexo');
            $table->string('direccion');
            $table->integer('telefono');

            //Llaves foraneas
            // $table->bigInteger('producto_id')->unsigned()->nullable();
            // $table->foreign('producto_id')->references('id')->on('productos')
            //                                                  ->onDelete('cascade')
            //                                                  ->onUpdate('cascade');

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
        Schema::dropIfExists('proveedores');
    }
};
