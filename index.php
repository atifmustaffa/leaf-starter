<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require __DIR__ . '/app/configs.php';

require __DIR__ . '/app/helpers.php';

require __DIR__ . '/app/templates.php';

require __DIR__ . '/app/database.php';

require __DIR__ . '/app/auth.php';

require __DIR__ . '/app/middleware.php';

require __DIR__ . '/app/routes.php';

app()->csrf();

app()->run();
