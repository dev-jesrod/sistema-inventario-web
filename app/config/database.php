<?php

$config = require __DIR__ . '/database.local.php';

$dsn = "mysql:host={$config['host']};dbname={$config['database']};charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

$conexion = new PDO(
    $dsn,
    $config['username'],
    $config['password'],
    $options
);

return $conexion;