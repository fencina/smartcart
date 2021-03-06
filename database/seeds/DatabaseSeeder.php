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
         $this->call(RolesSeeder::class);
         $this->call(SuperAdminSeeder::class);
         $this->call(ProductCategoriesSeeder::class);
         $this->call(ProductsSeeder::class);
         $this->call(StatusesSeeder::class);
         $this->call(AddEPCToProducts::class);
    }
}
