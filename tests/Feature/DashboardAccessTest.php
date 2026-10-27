<?php

use App\Models\User;

test('anonymous is redirected to login', function () {
    $this->get(route('dashboard'))->assertRedirect(route('login'));
});

test('user with any role can open the dashboard', function (array $roles) {
    $user = User::factory()->withRoles(...$roles)->create();

    $this->actingAs($user)->get(route('dashboard'))->assertOk();
})->with([
    'admin' => [['admin']],
    'guest' => [['guest']],
    'admin and guest' => [['admin', 'guest']],
]);

test('user without roles is forbidden', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get(route('dashboard'))->assertForbidden();
});
