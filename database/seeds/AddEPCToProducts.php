<?php

use Illuminate\Database\Seeder;

class AddEPCToProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Product::count() > 5) {
            $this->command->info('Products already in DB');
            return;
        }

        $products = [
            [
                'name' => 'Rollo de Cocina x3',
                'price' => 25.75,
                'category_id' => 4,
            ],
            [
                'name' => 'Lata de atún',
                'price' => 19.99,
                'category_id' => 5,
            ],
            [
                'name' => 'Puré Chef',
                'price' => 24.00,
                'category_id' => 1,
            ],
            [
                'name' => 'Tablet Samsung Note',
                'price' => 1299.99,
                'category_id' => 2,
            ],
        ];


        foreach ($products as $product) {
            \App\Product::create($product);
        }

        $this->command->info('New products created successfully');

        $epcs = [
            'e2 00 51 69 65 0e 01 81 15 50 7a 74',
            'e2 00 51 80 00 08 02 35 15 40 7b 3b',
            'e2 00 51 80 00 08 02 47 15 90 74 99',
            'e2 00 51 80 00 0e 01 27 16 80 6a 49',
            'e2 00 00 16 01 02 02 31 09 50 b9 75',
            'e2 00 00 16 01 02 02 12 09 50 b9 40',
            'e2 00 00 16 01 02 02 32 09 50 b9 6e',
            'e2 00 00 16 01 02 02 15 09 50 b9 55',
            'e2 00 00 16 01 02 02 26 09 50 b9 5f',
        ];

        $i = 0;
        \App\Product::all()->each(function ($product) use (&$i, $epcs) {
            $product->epc = $epcs[$i];
            $product->save();
            $i++;
        });

        $this->command->info('EPCs updated successfully');
    }
}
