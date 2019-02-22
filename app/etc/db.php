<?php

$host = 'localhost';
$username = 'root';
$password = 'magento';
$database = 'shelf_dev';

return [
    'db' => [
        'driver' => 'Pdo',
        'dns' => 'mysql:dbname=' . $database . ';host=' . $host,
        'username' => $username,
        'password' => $password,
        'host' => $host,
        'database' => $database
    ]
];
