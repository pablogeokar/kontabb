<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyClientes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
       
        Schema::table('clientes', function ($table) {
            $table->integer('id_forma_tributacao')->unsigned()->default(1);
            $table->foreign('id_forma_tributacao')->references('id')->on('forma_tributacaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
