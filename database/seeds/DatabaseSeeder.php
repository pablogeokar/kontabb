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
        /*
        DB::table('users')->insert([
            'name' => 'Pablo George',
            'email' => 'pablogeokar@hotmail.com',
            'password' => Hash::make('230435'),
        ]);
         * 
         */

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
    }

}
