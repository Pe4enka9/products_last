<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

$sql = "UPDATE `categories` SET name = :name WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'name' => $_POST['name'],
    'id' => $_POST['id'],
]);

header('Location: /products/categories.php');