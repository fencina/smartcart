<?php

use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\ProductCategory::count() > 0) {
            $this->command->info('Categories already in DB');
            return;
        }

        $categories = [
            ['id' => 1, 'name' => 'Lácteos'],
            ['id' => 2, 'name' => 'Electrodomésticos'],
            ['id' => 3, 'name' => 'Bebidas'],
            ['id' => 4, 'name' => 'Ropa'],
            ['id' => 5, 'name' => 'Fideos'],
        ];

        foreach ($categories as $category) {
            \App\ProductCategory::create($category);
        }

        $this->command->info('Categories created successfully');
    }
}
