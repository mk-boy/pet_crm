<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Enums\UserRole;

class RoleSeeder extends Seeder
{
    /**
     * Создание базового набора ролей
     */
    public function run(): void
    {
        Role::create(['role_name' => UserRole::ADMIN->value]);
        Role::create(['role_name' => UserRole::GUEST->value]);
        Role::create(['role_name' => UserRole::MANAGER->value]);
        Role::create(['role_name' => UserRole::DEVELOPER->value]);
    }
}
