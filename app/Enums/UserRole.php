<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case GUEST = 'guest';
    case MANAGER = 'manager';
    case DEVELOPER = 'developer';

    /**
     * Переведенное название роли
     */
    public function label(): string
    {
        return __("roles.{$this->value}");
    }
}
