<?php

use App\Models\User;

test('anonymous is redirected to login', function (string $method, string $uri) {
    $this->call($method, $uri)->assertRedirect(route('login'));
})->with('user_routes');

test('user without the admin role is forbidden', function (array $roles, string $method, string $uri) {
    $user = User::factory()->withRoles(...$roles)->create();

    $this->actingAs($user)->call($method, $uri)->assertForbidden();
})->with('non_admin_roles')->with('user_routes');

test('forbidden request does not change users', function (array $roles) {
    $user = User::factory()->withRoles(...$roles)->create();
    $target = User::factory()->create(['name' => 'Original Name']);

    $this->actingAs($user)->put(route('users.update', $target), ['name' => 'Changed Name']);
    $this->actingAs($user)->delete(route('users.destroy', $target));

    expect($target->fresh()->name)->toBe('Original Name');
})->with('non_admin_roles');
