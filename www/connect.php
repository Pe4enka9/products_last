<?php

$host = "database";
$dbname = "docker";
$username = "root";
$password = "tiger";

$database = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    return $pdo = new PDO($database, $username, $password);
} catch (PDOException $e) {
    die("Error" . $e->getMessage());
}