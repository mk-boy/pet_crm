<?php

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    Role::create(['role_name' => UserRole::GUEST]);

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('new users get the guest role', function () {
    Role::create(['role_name' => UserRole::GUEST]);

    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    expect(User::firstWhere('email', 'test@example.com')->roles->pluck('role_name')->all())
        ->toBe([UserRole::GUEST]);
});
