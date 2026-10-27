<?php

use App\Models\User;

dataset('user_routes', function () {
    return [
        'index' => ['GET', fn () => route('users.index')],
        'create' => ['GET', fn () => route('users.create')],
        'store' => ['POST', fn () => route('users.store')],
        'show' => ['GET', fn () => route('users.show', User::factory()->create())],
        'edit' => ['GET', fn () => route('users.edit', User::factory()->create())],
        'update_put' => ['PUT', fn () => route('users.update', User::factory()->create())],
        'update_patch' => ['PATCH', fn () => route('users.update', User::factory()->create())],
        'destroy' => ['DELETE', fn () => route('users.destroy', User::factory()->create())],
    ];
});
