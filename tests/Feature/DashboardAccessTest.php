<?php

use App\Enums\UserRole;
use App\Models\User;

test('anonymous is redirected to login', function () {
    $this->get(route('dashboard'))->assertRedirect(route('login'));
});

test('user with any role can open the dashboard', function (array $roles) {
    $user = User::factory()->withRoles(...$roles)->create();

    $this->actingAs($user)->get(route('dashboard'))->assertOk();
})->with([
    'admin' => [[UserRole::ADMIN]],
    'guest' => [[UserRole::GUEST]],
    'admin and guest' => [[UserRole::ADMIN, UserRole::GUEST]],
]);

test('user without roles is forbidden', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get(route('dashboard'))->assertForbidden();
});
