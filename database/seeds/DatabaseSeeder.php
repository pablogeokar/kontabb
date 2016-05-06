<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Pablo George',
            'email' => 'pablogeokar@hotmail.com',
            'password' => Hash::make('230435'),
        ]);
    }
}
