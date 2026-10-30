<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Создание базового набора ролей
     */
    public function run(): void
    {
        Role::firstOrCreate(['role_name' => UserRole::ADMIN->value]);
        Role::firstOrCreate(['role_name' => UserRole::GUEST->value]);
        Role::firstOrCreate(['role_name' => UserRole::MANAGER->value]);
        Role::firstOrCreate(['role_name' => UserRole::DEVELOPER->value]);
    }
}
