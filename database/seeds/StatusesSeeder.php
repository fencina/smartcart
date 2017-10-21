<?php

use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Status::count() > 0) {
            $this->command->info('Statuses already in DB');
            return;
        }

        $statuses = [
            [
                'id' => 1,
                'name' => 'Pendiente'
            ],
            [
                'id' => 2,
                'name' => 'Confirmada'
            ],
        ];

        foreach ($statuses as $status) {
            \App\Status::create($status);
        }

        $this->command->info('Statuses created successfully');
    }
}
