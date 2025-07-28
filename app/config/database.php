<?php

return [
    'driver' => 'pgsql',
    'host' => $_ENV['DB_HOST'] ?? 'localhost',
    'port' => 5433,
    'dbname' => $_ENV['DB_NAME'] ?? 'projet-sa',
    'user' => $_ENV['DB_USER'] ?? 'pguserDaf',
    'password' => $_ENV['DB_PASSWORD'] ?? 'pgpassword',
    'charset' => 'utf8',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];
