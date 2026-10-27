<?php

dataset('admin_roles', [
    'admin' => [['admin']],
    'admin and guest' => [['admin', 'guest']],
]);

dataset('non_admin_roles', [
    'guest' => [['guest']],
    'without roles' => [[]],
]);
