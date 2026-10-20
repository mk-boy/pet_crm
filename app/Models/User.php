<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use InvalidArgumentException;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Фильтрация выборки по search_query
     */
    #[Scope]
    protected function search(Builder $query, ?string $search_query)
    {
        $query->when($search_query, function (Builder $query, string $search_query) {
            $query->where(function (Builder $subQuery) use ($search_query) {
                $subQuery->whereLike('name', "%{$search_query}%")
                    ->orWhereLike('email', "%{$search_query}%");
            });
        });
    }

    /**
     * Фильтрация выборки по роли
     */
    #[Scope]
    protected function searchForRole(Builder $query, ?int $role_id)
    {
        $query->when($role_id, fn (Builder $query) => $query->whereRelation('roles', 'roles.id', $role_id));
    }

    /**
     * Получение ролей пользователя
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Проверка: есть ли у пользователя нужная роль
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles->contains('role_name', $roleName);
    }

    /**
     * Проверка: есть ли у пользователя хотя бы одна из ролей
     *
     * @param  array<int, string>  $roleNames
     */
    public function hasAnyRole(array $roleNames): bool
    {
        return $this->roles->contains(fn (Role $role) => in_array($role->role_name, $roleNames, true));
    }

    /**
     * Назначение ролей пользователю
     */
    public function assignRole(string ...$roleNames): void
    {
        $roleIds = Role::whereIn('role_name', $roleNames)->pluck('id');

        if (count(array_unique($roleNames)) !== $roleIds->count()) {
            throw new InvalidArgumentException('Переданы невалидные имена ролей');
        }

        $this->roles()->syncWithoutDetaching($roleIds);

        $this->unsetRelation('roles');
    }

    /**
     * Синхронизация списка ролей у пользователя
     *
     * @param  array<int, int>  $roleIds
     */
    public function syncRoles(array $roleIds): void
    {
        $this->roles()->sync($roleIds);

        $this->unsetRelation('roles');
    }
}
