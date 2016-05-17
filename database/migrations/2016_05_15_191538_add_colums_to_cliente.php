<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('clientes', function($table){            
            $table->boolean('cl_fl_pagto')->nullable();
            $table->boolean('cl_fgts')->nullable();
            $table->boolean('cl_gps')->nullable();
            $table->boolean('cl_simples')->nullable();
            $table->boolean('cl_darf_prolabore')->nullable();
            $table->boolean('cl_cont_sindical')->nullable();
            $table->boolean('controla_obrigacoes')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
