<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

#[Fillable(['role_name'])]
class Role extends Model
{
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
            ->map(fn (string $roleName): string => __("roles.$roleName"));
    }
}
