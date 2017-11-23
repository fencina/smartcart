<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CleanDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::transaction(function () {

                DB::delete('delete from list_product');
                DB::delete('delete from product_purchase');
                DB::delete('delete from client_group');
                DB::delete('delete from lists');
                DB::delete('delete from purchases');
                DB::delete('delete from groups');
                DB::delete('delete from clients');
            });
        } catch (Exception $exception) {
            $this->command->info($exception->getMessage());
            return;
        }

        $this->command->info('Database cleared');
    }
}
