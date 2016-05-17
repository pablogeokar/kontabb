<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);
      
        //Usuários       
        DB::table('users')->insert([
            'name' => 'Pablo George',
            'email' => 'pablogeokar@hotmail.com',
            'password' => Hash::make('230435'),
        ]);
         
        //Formas de Tributação
        DB::table('forma_tributacaos')->insert([
            'nome' => 'Simples Nacional',
        ]);
        DB::table('forma_tributacaos')->insert([
            'nome' => 'Lucro Real',
        ]);
        DB::table('forma_tributacaos')->insert([
            'nome' => 'Lucro Presumido',
        ]);
        DB::table('forma_tributacaos')->insert([
            'nome' => 'MEI',
        ]);
        DB::table('forma_tributacaos')->insert([
            'nome' => 'Simples Inativa',
        ]);
        DB::table('forma_tributacaos')->insert([
            'nome' => 'Inativa Receita Federal',
        ]);
         
        
        //CLiente
        DB::table('clientes')->insert([
            'cpf_cnpj' => '09044368000126',
            'nome_razaosocial' => 'P G C C BORGES INFORMÁTICA'
        ]);
         
        
        //Obrigação
        DB::table('obrigacaos')->insert([
            'cpf_cnpj' => '09044368000126',
            'mes' => 5,
            'ano' => 2016,
            'fl_pagto' => true
        ]);
        
    }

}
