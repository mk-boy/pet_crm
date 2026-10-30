<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case GUEST = 'guest';
    case MANAGER = 'manager';
    case DEVELOPER = 'developer';
}
