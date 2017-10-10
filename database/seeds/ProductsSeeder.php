<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Product::count() > 0) {
            $this->command->info('Products already in DB');
            return;
        }

        $products = [
            [
                'name' => 'Coca-Cola 3lt.',
                'price' => 50,
                'category_id' => 3,
            ],
            [
                'name' => 'Leche Cartón La Serenisima',
                'price' => 13.50,
                'category_id' => 1,
            ],
            [
                'name' => 'TV Samsung 40\'\'',
                'price' => 50,
                'category_id' => 2,
            ],
            [
                'name' => 'Short Nike',
                'price' => 520,
                'category_id' => 4,
            ],
            [
                'name' => 'Matarazzo Coditos',
                'price' => 27.50,
                'category_id' => 5,
            ],
        ];

        foreach ($products as $product) {
            \App\Product::create($product);
        }

        $this->command->info('Products created successfully');
    }
}
