<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
