<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Может ли пользователь просматривать список моделей.
     */
    public function viewAny(User $user): bool
    {
        return $user->role?->role_name === 'admin';
    }

    /**
     * Может ли пользователь просматривать конкретную модель.
     */
    public function view(User $user, User $model): bool
    {
        return $user->role?->role_name === 'admin';
    }

    /**
     * Может ли пользователь создавать модели.
     */
    public function create(User $user): bool
    {
        return $user->role?->role_name === 'admin';
    }

    /**
     * Может ли пользователь обновлять модель.
     */
    public function update(User $user, User $model): bool
    {
        return $user->role?->role_name === 'admin';
    }

    /**
     * Может ли пользователь удалять модель.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->role?->role_name === 'admin';
    }

    /**
     * Может ли пользователь восстанавливать модель.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->role?->role_name === 'admin';
    }

    /**
     * Может ли пользователь безвозвратно удалять модель.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
