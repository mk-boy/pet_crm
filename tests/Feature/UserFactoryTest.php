<?php

use App\Models\Role;
use App\Models\User;

test('withRoles assigns all given roles in an empty database', function () {
    $user = User::factory()->withRoles('admin', 'guest')->create();

    expect($user->roles->pluck('role_name')->sort()->values()->all())->toBe(['admin', 'guest']);
});

test('withRoles reuses existing roles instead of duplicating them', function () {
    User::factory()->withRoles('admin')->create();
    User::factory()->withRoles('admin')->create();

    expect(Role::where('role_name', 'admin')->count())->toBe(1);
});

test('chained withRoles calls combine roles', function () {
    $user = User::factory()->withRoles('admin')->withRoles('guest')->create();

    expect($user->roles->pluck('role_name')->sort()->values()->all())->toBe(['admin', 'guest']);
});
