<?php

$host = "database";
$dbname = "docker";
$username = "root";
$password = "tiger";

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

return $pdo = new PDO($dsn, $username, $password, $options);