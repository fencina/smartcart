<?php

use Illuminate\Database\Seeder;

class OperatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operators')->insert([
            'name' => 'cristian',
            'last_name' => 'rojas',
            'email' => 'rojas.r.cristian@gmail.com',
            'password' => bcrypt('secret')
        ]);

        DB::table('operators')->insert([
            'name' => 'facundo',
            'last_name' => 'encina',
            'email' => 'fencina@gmail.com',
            'password' => bcrypt('secret')
        ]);
    }
}
