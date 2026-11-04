<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

#[Fillable(['role_name'])]
class Role extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role_name' => UserRole::class,
        ];
    }

    /**
     * Все пользователи по роли
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Возвращает коллекцию в виде id => переведенное название
     */
    public static function options(): Collection
    {
        return static::orderBy('role_name', 'desc')
            ->pluck('role_name', 'id')
            ->map(fn (UserRole $roleName): string => $roleName->label());
    }
}
