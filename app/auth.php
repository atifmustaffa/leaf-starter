<?php

use App\Support\MyRolePermissions;

auth()->dbConnection(mydb()->getConnection());
auth()->config([
  // 'db.table' => 'admins', // Default: users
  'session'        => true,
  'session.cookie' => [
    'secure'   => true,
    'httponly' => true,
    'samesite' => 'lax'
  ],
  'token.lifetime', 60 * 60 // 1 hour
]);

// Build and register roles
$rolesPermissions = require __DIR__ . '/../app/configs/roles.php';
$rolesBuilder = new MyRolePermissions($rolesPermissions);
$finalRoles = $rolesBuilder->build();

auth()->createRoles($finalRoles);