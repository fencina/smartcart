<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Role::count() > 0) {
            $this->command->info('Roles already in DB');
            return;
        }

        $roles = [
            ['id' => \App\Role::SUPER_ADMIN, 'name' => 'SuperAdmin'],
            ['id' => \App\Role::ADMIN_USERS, 'name' => 'Administrador Usuarios'],
            ['id' => \App\Role::ADMIN_PUSH, 'name' => 'Notificaciones Push'],
            ['id' => \App\Role::CASHIER, 'name' => 'Cajero'],
        ];

        foreach ($roles as $role) {
            \App\Role::create($role);
        }

        $this->command->info('Roles created successfully');
    }
}
