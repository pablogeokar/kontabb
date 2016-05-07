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
