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
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role_id'])]
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
     * Фильтрация выборки по role_id
     */
    #[Scope]
    protected function searchForRole(Builder $query, ?int $role_id)
    {
        $query->when($role_id, function (Builder $query, int $role_id) {
            $query->where('role_id', $role_id);
        });
    }

    /**
     * Получение роли пользователя
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
