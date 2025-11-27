<?php

return [
  'groups' => [
    'user.read'  => ['view user', 'view users'],
    'user.write' => ['create user', 'update user', 'delete user'],
  ],

  'roles'  => [
    'admin' => [
      'groups'      => [],   // Not needed since it will be given full access
      'permissions' => [],   // Not needed since it will be given full access
    ],

    'user'  => [
      'groups'      => ['user.read'],
      'permissions' => [],
    ],

    'guest' => [
      'groups'      => [],
      'permissions' => [],
    ],
  ],
];
