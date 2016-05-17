<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObrigacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obrigacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf_cnpj', 18);
            $table->integer('mes');
            $table->integer('ano');
            $table->boolean('fl_pagto')->nullable();
            $table->boolean('fgts')->nullable();
            $table->boolean('gps')->nullable();
            $table->boolean('simples')->nullable();
            $table->boolean('darf_prolabore')->nullable();
            $table->boolean('cont_sindical')->nullable();
            $table->timestamps();
            
            $table->foreign('cpf_cnpj')->references('cpf_cnpj')->on('clientes');
            $table->unique('cpf_cnpj', 'mes', 'ano');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('obrigacaos');
    }
}
