<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\User::whereId(1)->first()) {
            $this->command->info('The superadmin user is already in DB');
            return;
        }

        $superAdmin = [
            'id' => 1,
            'name' => 'SuperAdmin',
            'last_name' => 'SuperAdmin',
            'file_number' => 'SuperAdmin',
            'email' => 'admin@smartcart.com',
            'password' => bcrypt('smart1234'),
            'role_id' => \App\Role::SUPER_ADMIN,
        ];

        \App\User::create($superAdmin);
    }
}
