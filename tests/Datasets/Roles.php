<?php

use App\Enums\UserRole;

dataset('admin_roles', [
    'admin' => [[UserRole::ADMIN]],
    'admin and guest' => [[UserRole::ADMIN, UserRole::GUEST]],
]);

dataset('non_admin_roles', [
    'guest' => [[UserRole::GUEST]],
    'without roles' => [[]],
]);
