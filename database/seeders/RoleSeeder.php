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
        Role::firstOrCreate(['role_name' => UserRole::ADMIN]);
        Role::firstOrCreate(['role_name' => UserRole::GUEST]);
        Role::firstOrCreate(['role_name' => UserRole::MANAGER]);
        Role::firstOrCreate(['role_name' => UserRole::DEVELOPER]);
    }
}
