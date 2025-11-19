<?php

auth()->dbConnection(mydb()->getConnection());
auth()->config([
  // 'db.table' => 'admins', // Default: users
  'session' => true,
  'session.cookie' => [
    'secure' => true,
    'httponly' => true,
    'samesite' => 'lax'
  ],
  'token.lifetime', 60 * 60 // 1 hour
]);
