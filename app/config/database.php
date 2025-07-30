<?php

return [
    'driver' => 'pgsql',
    'host' => $_ENV['DB_HOST'] ?? 'trolley.proxy.rlwy.net',
    'port' => 49837,
    'dbname' => $_ENV['DB_NAME'] ?? 'railway',
    'user' => $_ENV['DB_USER'] ?? 'postgres',
    'password' => $_ENV['DB_PASSWORD'] ?? 'XIZTLyhVomWBrburwbhfAEHzLQudImXa',
    'charset' => 'utf8',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];
