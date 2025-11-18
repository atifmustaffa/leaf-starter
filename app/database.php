<?php

use App\Support\MyDb;

$host = _env('DB_HOST', '127.0.0.1');
$port = _env('DB_PORT', '3306');
$database = _env('DB_DATABASE', '');
$username = _env('DB_USERNAME', 'root');
$password = _env('DB_PASSWORD', '');
$charset = _env('DB_CHARSET', 'utf8mb4');

$dsn = "mysql:host={$host};port={$port};dbname={$database};charset={$charset}";
$pdo = createPdo($dsn, $username, $password);

$myConnections = [
  'default' => $pdo,
  // Add more connections here
];

// Store in leaf config for future use
app()->config('db.connections', $myConnections);

// Use mydb() to access the database instead of db()
function mydb($name = 'default'): MyDb
{
  static $addon = null;

  if (!$addon) {
    $addon = new MyDb(db(), app()->config('db.connections'));
  }

  $addon->useConnection($name);

  return $addon;
}

function createPdo(string $dsn, string $username, string $password): PDO
{
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_PERSISTENT => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
  ];

  try {
    return new PDO($dsn, $username, $password, $options);
  } catch (\PDOException $e) {
    error_log("[DB ERROR] PDO init failed: {$e->getMessage()}");
    throw $e;
  }
}