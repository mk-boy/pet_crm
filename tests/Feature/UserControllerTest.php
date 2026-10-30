<?php

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @return array{name: string, email: string, password: string, role_ids: array<int, int>}
 */
function validUserPayload(array $overrides = []): array
{
    return [
        'name' => 'New User',
        'email' => 'new.user@example.com',
        'password' => 'secret-password',
        'role_ids' => [Role::firstOrCreate(['role_name' => UserRole::GUEST])->id],
        ...$overrides,
    ];
}

describe('admin actions', function () {
    test('index lists users', function (array $roles) {
        $admin = User::factory()->withRoles(...$roles)->create();
        $listedUser = User::factory()->create(['name' => 'Listed User']);

        $this->actingAs($admin)
            ->get(route('users.index'))
            ->assertOk()
            ->assertViewIs('users.index')
            ->assertSee('Listed User');
    })->with('admin_roles');

    test('create shows the form', function (array $roles) {
        $admin = User::factory()->withRoles(...$roles)->create();

        $this->actingAs($admin)
            ->get(route('users.create'))
            ->assertOk()
            ->assertViewIs('users.create');
    })->with('admin_roles');

    test('show responds with an empty page', function (array $roles) {
        $admin = User::factory()->withRoles(...$roles)->create();

        $this->actingAs($admin)
            ->get(route('users.show', User::factory()->create()))
            ->assertOk()
            ->assertNoContent(200);
    })->with('admin_roles');

    test('edit shows the form for the user', function (array $roles) {
        $admin = User::factory()->withRoles(...$roles)->create();
        $target = User::factory()->create();

        $this->actingAs($admin)
            ->get(route('users.edit', $target))
            ->assertOk()
            ->assertViewIs('users.edit')
            ->assertViewHas('user', fn (User $user) => $user->is($target));
    })->with('admin_roles');

    test('store creates a user with roles', function (array $roles) {
        $admin = User::factory()->withRoles(...$roles)->create();
        $adminRole = Role::firstWhere('role_name', UserRole::ADMIN);

        $this->actingAs($admin)
            ->post(route('users.store'), validUserPayload(['role_ids' => [$adminRole->id]]))
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('toast', __('users.created'));

        $created = User::firstWhere('email', 'new.user@example.com');

        expect($created)->not->toBeNull()
            ->and($created->name)->toBe('New User')
            ->and($created->roles->pluck('role_name')->all())->toBe([UserRole::ADMIN]);
    })->with('admin_roles');

    test('update changes the user and replaces roles', function (array $roles) {
        $admin = User::factory()->withRoles(...$roles)->create();
        $target = User::factory()->withRoles(UserRole::ADMIN)->create();

        $this->actingAs($admin)
            ->put(route('users.update', $target), validUserPayload())
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('toast', __('users.updated'));

        $target->refresh();

        expect($target->name)->toBe('New User')
            ->and($target->email)->toBe('new.user@example.com')
            ->and($target->roles->pluck('role_name')->all())->toBe([UserRole::GUEST]);
    })->with('admin_roles');

    test('destroy deletes the user', function (array $roles) {
        $admin = User::factory()->withRoles(...$roles)->create();
        $target = User::factory()->withRoles(UserRole::GUEST)->create();

        $this->actingAs($admin)
            ->delete(route('users.destroy', $target))
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('toast', __('users.deleted'));

        $this->assertModelMissing($target);
        $this->assertDatabaseMissing('role_user', ['user_id' => $target->id]);
    })->with('admin_roles');
});

describe('index filters', function () {
    test('search_query filters by name or email', function () {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create();
        User::factory()->create(['name' => 'Alice Smith', 'email' => 'alice@example.com']);
        User::factory()->create(['name' => 'Bob Jones', 'email' => 'bob.mail@example.com']);
        User::factory()->create(['name' => 'Carol White', 'email' => 'carol@example.com']);

        $this->actingAs($admin)
            ->get(route('users.index', ['search_query' => 'ali']))
            ->assertSee('Alice Smith')
            ->assertDontSee('Bob Jones');

        $this->actingAs($admin)
            ->get(route('users.index', ['search_query' => 'bob.mail']))
            ->assertSee('Bob Jones')
            ->assertDontSee('Carol White');
    });

    test('role_id filters by role', function () {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create();
        User::factory()->withRoles(UserRole::GUEST)->create(['name' => 'Guest Person']);
        User::factory()->create(['name' => 'Roleless Person']);

        $this->actingAs($admin)
            ->get(route('users.index', ['role_id' => Role::firstWhere('role_name', UserRole::GUEST)->id]))
            ->assertSee('Guest Person')
            ->assertDontSee('Roleless Person');
    });
});

describe('store validation', function () {
    test('requires all fields', function () {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create();

        $this->actingAs($admin)
            ->post(route('users.store'), [])
            ->assertInvalid([
                'name' => 'Поле имя обязательно для заполнения.',
                'email' => 'Поле email обязательно для заполнения.',
                'password' => 'Поле пароль обязательно для заполнения.',
                'role_ids' => 'Поле роли обязательно для заполнения.',
            ]);

        expect(User::count())->toBe(1);
    });

    test('rejects invalid values', function (array $overrides, string $field, string $message) {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create(['email' => 'taken@example.com']);

        $this->actingAs($admin)
            ->post(route('users.store'), validUserPayload($overrides))
            ->assertInvalid([$field => $message]);

        expect(User::count())->toBe(1);
    })->with([
        'taken email' => [['email' => 'taken@example.com'], 'email', 'Такое значение поля email уже существует.'],
        'uppercase email' => [['email' => 'New.User@example.com'], 'email', 'Поле email должно быть в нижнем регистре.'],
        'short password' => [['password' => 'short'], 'password', 'Поле пароль должно содержать не меньше 8 символов.'],
        'unknown role' => [['role_ids' => [999]], 'role_ids.0', 'Выбрано недопустимое значение поля роль.'],
    ]);
});

describe('update validation', function () {
    test('requires name, email and roles but not password', function () {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create();
        $target = User::factory()->create();

        $this->actingAs($admin)
            ->put(route('users.update', $target), [])
            ->assertInvalid(['name', 'email', 'role_ids'])
            ->assertValid(['password']);
    });

    test('accepts the user own email', function () {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create();
        $target = User::factory()->create(['email' => 'target@example.com']);

        $this->actingAs($admin)
            ->put(route('users.update', $target), validUserPayload(['email' => 'target@example.com']))
            ->assertValid();
    });

    test('rejects an email of another user', function () {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create(['email' => 'taken@example.com']);
        $target = User::factory()->create(['email' => 'target@example.com']);

        $this->actingAs($admin)
            ->put(route('users.update', $target), validUserPayload(['email' => 'taken@example.com']))
            ->assertInvalid(['email' => 'Такое значение поля email уже существует.']);

        expect($target->fresh()->email)->toBe('target@example.com');
    });

    test('rejects a short new password', function () {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create();
        $target = User::factory()->create();

        $this->actingAs($admin)
            ->put(route('users.update', $target), validUserPayload(['password' => 'short']))
            ->assertInvalid(['password' => 'Поле пароль должно содержать не меньше 8 символов.']);
    });
});

describe('password handling', function () {
    test('store saves the password hashed', function () {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create();

        $this->actingAs($admin)->post(route('users.store'), validUserPayload());

        $storedPassword = User::firstWhere('email', 'new.user@example.com')->password;

        expect($storedPassword)->not->toBe('secret-password')
            ->and(Hash::check('secret-password', $storedPassword))->toBeTrue();
    });

    test('update keeps the password when it is left blank', function (?string $blankPassword) {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create();
        $target = User::factory()->create(['password' => 'old-password']);

        $this->actingAs($admin)
            ->put(route('users.update', $target), validUserPayload(['password' => $blankPassword]))
            ->assertValid();

        expect(Hash::check('old-password', $target->fresh()->password))->toBeTrue();
    })->with([
        'empty string' => [''],
        'null' => [null],
    ]);

    test('update replaces the password with a hashed new one', function () {
        $admin = User::factory()->withRoles(UserRole::ADMIN)->create();
        $target = User::factory()->create(['password' => 'old-password']);

        $this->actingAs($admin)->put(route('users.update', $target), validUserPayload(['password' => 'new-password']));

        $storedPassword = $target->fresh()->password;

        expect($storedPassword)->not->toBe('new-password')
            ->and(Hash::check('new-password', $storedPassword))->toBeTrue();
    });

    test('password is hidden from serialization', function () {
        $user = User::factory()->create();

        expect($user->toArray())->not->toHaveKeys(['password', 'remember_token']);
    });
});
