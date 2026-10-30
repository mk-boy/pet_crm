<?php

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;

test('withRoles assigns all given roles in an empty database', function () {
    $user = User::factory()->withRoles(UserRole::ADMIN, UserRole::GUEST)->create();

    expect($user->roles->pluck('role_name')->all())->toEqualCanonicalizing([UserRole::ADMIN, UserRole::GUEST]);
});

test('withRoles reuses existing roles instead of duplicating them', function () {
    User::factory()->withRoles(UserRole::ADMIN)->create();
    User::factory()->withRoles(UserRole::ADMIN)->create();

    expect(Role::where('role_name', 'admin')->count())->toBe(1);
});

test('chained withRoles calls combine roles', function () {
    $user = User::factory()->withRoles(UserRole::ADMIN)->withRoles(UserRole::GUEST)->create();

    expect($user->roles->pluck('role_name')->all())->toEqualCanonicalizing([UserRole::ADMIN, UserRole::GUEST]);
});
