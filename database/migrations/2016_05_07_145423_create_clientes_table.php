<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('clientes', function (Blueprint $table) {
            $table->string('cpf_cnpj', 18);
            $table->string('nome_razaosocial', 160);
            $table->string('cpf_responsavel', 14)->nullable();
            $table->string('nome_responsavel', 160)->nullable();
            $table->string('codigo_simplesnacional', 12)->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->boolean('cl_fl_pagto')->nullable();
            $table->boolean('cl_fgts')->nullable();
            $table->boolean('cl_gps')->nullable();
            $table->boolean('cl_simples')->nullable();
            $table->boolean('cl_darf_prolabore')->nullable();
            $table->boolean('cl_cont_sindical')->nullable();
            $table->boolean('controla_obrigacoes')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->primary('cpf_cnpj');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clientes');
    }
}
